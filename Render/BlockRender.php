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
        
        foreach( $this->block->getContext()->getAll() as $contextKey => $contextItem ) 
        {       
            $value = '';

            if ( isset( $override[ $contextItem->getId() ] ) && $override[ $contextItem->getId() ] ) 
            {
                if ( isset( $override[ $contextItem->getId() ]['value'] ) && $override[ $contextItem->getId() ]['value'] ) 
                {
                    $value = $override[ $contextItem->getId() ]['value'];
                }
            }
            
            if ( $contextItem->getPersist() == 'meta' ) {
                $context_key = $this->block->getKey() . '__' . $contextItem->getId();
                try {
                    $value = LinotypeCore::$db->findOneBy([ 'context_key' => $context_key ]) ? LinotypeCore::$db->findOneBy([ 'context_key' => $context_key ])->getContextValue() : $value;
                } 
                catch(\Exception $e){
                    $errorMessage = $e->getMessage();
                }
            }

            if ( $value ) $this->block->getContext()->getKey($contextKey)->setValue( $value );
            
        }
        return $this->block;
    }

}
