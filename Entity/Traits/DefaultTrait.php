<?php

namespace Linotype\Core\Entity\Traits;

use Linotype\Core\Helper\InfoHelper;

trait DefaultTrait
{
    private $id;

    private $version;

    private $author;
    
    private $name;
    
    private $desc;
    
    private $info;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setID(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getVersion(): ?float
    {
        return $this->version;
    }

    public function setVersion(float $version): self
    {
        $this->version = $version;

        return $this;
    }
    
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDesc(): ?string
    {
        return $this->desc;
    }

    public function setDesc(string $desc): self
    {
        $this->desc = $desc;

        return $this;
    }

    public function getInfo(): ?InfoHelper
    {
        return $this->info;
    }

    public function setInfo(string $id, string $dir)
    {
        $this->info = new InfoHelper($id, $dir);

        return $this;
    }
}