<?php

namespace Linotype\Core\Context;

use Linotype\Core\Context\BlockContextItem;

class BlockContext
{

    private $dir;

    private $path;

    private $contexts = [];

    public function findById($id): ?BlockContextItem
    {   
        return isset( $this->contexts[$id] ) ? $this->contexts[$id] : null;
    }

    public function getAll(): ?array
    {
        return $this->contexts;
    }

    public function getKey($id): ?BlockContextItem
    {
        return isset( $this->contexts[$id] ) ? $this->contexts[$id] : null;
    }

    public function setKey($id, $value): self
    {
        $this->contexts[$id] = $value;

        return $this;
    }

    public function addContext(BlockContextItem $context): self
    {
        $this->contexts[$context->getId()] = $context;

        return $this;
    }
    
}
