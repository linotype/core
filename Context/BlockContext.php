<?php

namespace Linotype\Core\Context;

use Linotype\Core\Context\BlockContextItem;

class BlockContext
{

    private $dir;

    private $path;

    private $contexts;

    public function findById($id): ?BlockContextItem
    {   
        return isset( $this->contexts[$id] ) ? $this->contexts[$id] : null;
    }

    public function getAll(): ?self
    {
        return $this->contexts;
    }

    public function getKey($id): ?BlockContextItem
    {
        return isset( $this->contexts[$id] ) ? $this->contexts[$id] : null;
    }

    public function addContext(BlockContextItem $context): self
    {
        $this->contexts[$context->getId()] = $context;

        return $this;
    }
    
}
