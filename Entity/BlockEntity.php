<?php

namespace Linotype\Core\Entity;

use Linotype\Core\Context\BlockContext;
use Linotype\Core\Entity\Traits\DefaultTrait;
use Linotype\Core\Entity\Traits\KeyTrait;

class BlockEntity 
{

    use DefaultTrait;
    use KeyTrait;

    private $id;

    private $key;

    private $version;

    private $author;
    
    private $name;
    
    private $desc;
    
    private $info;

    private $package;
    
    private $parent;

    private $accept;

    private $context;
    
    private $children;

    public function getPackage(): ?array
    {
        return $this->package;
    }

    public function setPackage(array $package): self
    {
        $this->package = $package;

        return $this;
    }

    public function getParent(): ?array
    {
        return $this->parent;
    }

    public function setParent(array $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getAccept(): ?array
    {
        return $this->accept;
    }

    public function setAccept(array $accept): self
    {
        $this->accept = $accept;

        return $this;
    }

    public function getContext(): ?BlockContext
    {
        return $this->context;
    }

    public function setContext(BlockContext $context): self
    {
        $this->context = $context;

        return $this;
    }

    public function getChildren(): ?array
    {
        return $this->children;
    }

    public function setChildren(array $children): self
    {
        $this->children = $children;

        return $this;
    }

}
