<?php

namespace Linotype\Core\Context;

class BlockContextItem
{

    private $id;

    private $key;

    private $name;

    private $desc;

    private $field;

    private $option;

    private $persist;

    private $value;

    private $default;

    private $preview;

    private $format;

    private $debug;

    private $js;
    
    private $css;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setID(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

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

    public function getField(): ?string
    {
        return $this->field;
    }

    public function setField(string $field): self
    {
        $this->field = $field;

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

    public function getPersist(): ?string
    {
        return $this->persist;
    }

    public function setPersist(string $persist = 'static'): self
    {
        if ( in_array( $persist, ['static','meta','option'] ) ) {
            $this->persist = $persist;
        } else {
            $this->persist = 'static';
        }
        
        return $this;
    }

    public function getValue()
    {
        if ( $this->value ) {
            $value = $this->value;
        } else {
            $value = $this->default;
        }
        return $value;
    }

    public function setValue($value = ''): self
    {
        $this->value = $value;

        return $this;
    }

    public function getDefault(): ?string
    {
        return $this->default;
    }

    public function setDefault(string $default): self
    {
        $this->default = $default;

        return $this;
    }

    public function getPreview(): ?string
    {
        return $this->preview;
    }

    public function setPreview(string $preview): self
    {
        $this->preview = $preview;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getDebug(): ?bool
    {
        return $this->debug;
    }

    public function setDebug(bool $debug): self
    {
        $this->debug = $debug;

        return $this;
    }

    public function getJs(): ?bool
    {
        return $this->js;
    }

    public function setJs(bool $js): self
    {
        $this->js = $js;

        return $this;
    }
    
    public function getCss(): ?bool
    {
        return $this->css;
    }

    public function setCss(bool $css): self
    {
        $this->css = $css;

        return $this;
    }

}
