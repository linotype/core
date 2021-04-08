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
            //get override value
            if ( isset( $override[ $contextItem->getId() ] ) && $override[ $contextItem->getId() ] )  {

                if ( isset( $override[ $contextItem->getId() ] ) ) {
                    foreach( $override[ $contextItem->getId() ] as $override_id => $override_value ) {
                        switch ( $override_id ) {
                            case 'value':
                                $this->block->getContext()->getKey($contextKey)->setValue( $override_value );
                            break;
                            case 'css':
                                $this->block->getContext()->getKey($contextKey)->setCss( $override_value );
                            break;
                        }
                    }
                    
                }
            }
            
            //get persist value
            if ( $this->block->getContext()->getKey($contextKey)->getPersist() == 'meta' ) {
                $meta_value = null;
                $context_key = $this->block->getKey() . '__' . $this->block->getContext()->getKey($contextKey)->getId();
                try {
                    $meta_value = LinotypeCore::$db->findOneBy([ 'context_key' => $context_key ]) ? LinotypeCore::$db->findOneBy([ 'context_key' => $context_key ])->getContextValue() : null;
                } 
                catch(\Exception $e){
                    $e->getMessage();
                }
                if ( $meta_value ) $this->block->getContext()->getKey($contextKey)->setValue( $meta_value );
            }


            //create custom js variable
            if ( $this->block->getContext()->getKey($contextKey)->getValue() && $this->block->getContext()->getKey($contextKey)->getJs() ) {
                if ( ! isset( $js[ '#' . $this->block->getCssId() ] ) ) $js[ $this->block->getCssId() ] = [];
                $js[ $this->block->getCssId() ][ $contextKey ] = $this->block->getContext()->getKey($contextKey)->getValue();
            }

            //create custom css variable
            if ( $this->block->getContext()->getKey($contextKey)->getValue() && $this->block->getContext()->getKey($contextKey)->getCss() ) {
                if ( ! isset( $css[ '#' . $this->block->getCssId() ] ) ) $css[ '#' . $this->block->getCssId() ] = [];
                $css[ '#' . $this->block->getCssId() ][ '--' . $contextKey ] = $this->block->getContext()->getKey($contextKey)->getValue();
            }
            
        }
        
        $this->block->setCustomJs( $js );
        $this->block->setCustomCss( $css );
        
        
        return $this->block;
    }

}
