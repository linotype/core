<?php

namespace Linotype\Core\Render;

use Linotype\Core\Context\BlockContext;
use Linotype\Core\Context\BlockContextItem;
use Linotype\Core\Entity\LinotypeEntity;
use Linotype\Core\Entity\BlockEntity;
use Linotype\Core\LinotypeCore;

class BlockRender
{

    private $output;

    private $block;

    public function __construct(BlockEntity $block, LinotypeEntity $linotype )
    {
        $this->block = $block;
        $this->blocks = $linotype->getBlocks();
    }

    public function render($override = [])
    {
        
        $js = [];
        $css = [];

        foreach( $this->block->getContext()->getAll() as $contextKey => $contextItem ) 
        {       
            $value = '';

            //get override value
            if ( isset( $override[ $contextItem->getId() ] ) && $override[ $contextItem->getId() ] ) 
            {
                if ( isset( $override[ $contextItem->getId() ]['value'] ) && $override[ $contextItem->getId() ]['value'] ) 
                {
                    $value = $override[ $contextItem->getId() ]['value'];
                }
            }
            
            //get persist value
            if ( $contextItem->getPersist() == 'meta' ) {
                $context_key = $this->block->getKey() . '__' . $contextItem->getId();
                try {
                    $value = LinotypeCore::$db->findOneBy([ 'context_key' => $context_key ]) ? LinotypeCore::$db->findOneBy([ 'context_key' => $context_key ])->getContextValue() : $value;
                } 
                catch(\Exception $e){
                    $value = $e->getMessage();
                }
            }

            //set new value
            if ( $value ) $this->block->getContext()->getKey($contextKey)->setValue( $value );


            //create custom js variable
            if ( $value && $contextItem->getJs() ) {
                if ( ! isset( $js[ '#' . $this->block->getCssId() ] ) ) $js[ $this->block->getCssId() ] = [];
                $js[ $this->block->getCssId() ][ $contextKey ] = $value;
            }

            //create custom css variable
            if ( $value && $contextItem->getCss() ) {
                if ( ! isset( $css[ '#' . $this->block->getCssId() ] ) ) $css[ '#' . $this->block->getCssId() ] = [];
                $css[ '#' . $this->block->getCssId() ][ '--' . $contextKey ] = $value;
            }
            
        }
        
        $this->block->setCustomJs( $js );
        $this->block->setCustomCss( $css );
        
        return $this->block;
    }

}
