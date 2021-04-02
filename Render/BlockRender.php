<?php

namespace Linotype\Core\Render;

use Linotype\Core\Context\BlockContext;
use Linotype\Core\Context\BlockContextItem;
use Linotype\Core\Entity\LinotypeEntity;
use Linotype\Core\Entity\BlockEntity;

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
            if ( isset( $override[ $contextItem->getId() ] ) && $override[ $contextItem->getId() ] ) 
            {
                if ( isset( $override[ $contextItem->getId() ]['value'] ) && $override[ $contextItem->getId() ]['value'] ) 
                {
                    $this->block->getContext()->getKey($contextKey)->setValue( $override[ $contextItem->getId() ]['value'] );
                }
            } 
        }

        return $this->block;
    }

}
