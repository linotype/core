<?php

namespace Linotype\Core\Entity;

use Linotype\Core\Entity\Traits\DefaultTrait;
use Linotype\Core\Entity\Traits\KeyTrait;
use Linotype\Core\Entity\Traits\TemplateRefTrait;

class FieldEntity
{

    use DefaultTrait;
    use KeyTrait;
    use TemplateRefTrait;

    private $id;

    private $key;

    private $version;

    private $author;
    
    private $name;
    
    private $desc;
    
    private $info;

    private $package;

    private $title;

    private $help;
    
    private $require;

    private $value;

    private $default;

    private $format;

    private $option;

    public function getPackage(): ?array
    {
        return $this->package;
    }

    public function setPackage(array $package): self
    {
        $this->package = $package;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getHelp(): ?string
    {
        return $this->help;
    }

    public function setHelp($help = ''): self
    {
        $this->help = $help;

        return $this;
    }

    public function getRequire(): ?bool
    {
        return $this->require;
    }

    public function setRequire(bool $require): self
    {
        $this->require = $require;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value = '')
    {
        $this->value = $value;

        return $this;
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function setDefault($default = '')
    {
        $this->default = $default;

        return $this;
    }

    public function getFormat(): ?array
    {
        return $this->format;
    }

    public function setFormat(array $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getOption(): ?array
    {
        return $this->option;
    }

    public function setOption(array $option): self
    {
        $this->option = $option;

        return $this;
    }

}
