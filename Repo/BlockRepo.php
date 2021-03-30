<?php

namespace Linotype\Core\Repo;

use Linotype\Core\Entity\BlockEntity;

class BlockRepo
{

    private $dir;

    private $path;

    private $blocks;

    public function findById($id): ?BlockEntity
    {   
        return isset( $this->blocks[$id] ) ? $this->blocks[$id] : null;
    }

    public function findByAuthor($author): ?array
    {   
        $blocksByAuthor = [];
        foreach( $this->blocks as $block ) {
            if ( $block->getAuthor() == $author ) {
                $blocksByAuthor[ $block->getId() ] = $block;
            }
        }
        return $blocksByAuthor;
    }

    public function getBlocks(): ?self
    {
        return $this->blocks;
    }

    public function getBlock($id): ?BlockEntity
    {
        return isset( $this->blocks[$id] ) ? $this->blocks[$id] : null;
    }

    public function addBlock(BlockEntity $block): self
    {
        $this->blocks[$block->getId()] = $block;

        return $this;
    }
    
}
