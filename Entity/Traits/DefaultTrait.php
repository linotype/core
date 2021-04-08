<?php

namespace Linotype\Core\Entity\Traits;

use Linotype\Core\Helper\InfoHelper;

trait DefaultTrait
{
    private $id;

    private $slug;

    private $cssClass;

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

        $this->setCssClass($id);

        $this->setSlug($id);

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = strtolower( preg_replace('/([a-z])([A-Z])/s','$1-$2', $slug ) );

        return $this;
    }

    public function getCssClass(): ?string
    {
        return $this->cssClass;
    }

    public function setCssClass(string $cssClass): self
    {
        $this->cssClass = 'block--' . strtolower( preg_replace('/([a-z])([A-Z])/s','$1-$2', $cssClass ) );

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

    public function setInfo(string $type, string $id, string $dir)
    {
        $this->info = new InfoHelper($type, $id, $dir);

        return $this;
    }
}