<?php

namespace Linotype\Core\Entity;

use Linotype\Core\Entity\Traits\DefaultTrait;
use Linotype\Core\Entity\Traits\KeyTrait;

class ThemeEntity
{

    use DefaultTrait;
    use KeyTrait;

    private $id;

    private $key;

    private $version;

    private $author;
    
    private $name;
    
    private $desc;

    private $locale;

    private $locales;
    
    private $info;

    private $map;
    
    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function getLocalesInline(string $separator = ',', string $before = '', string $after = ''): ?string
    {
        return implode( $separator, array_map( function( $item ) use ( $before, $after ) { return $before . $item . $after; }, array_keys( $this->locales ) ) );
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function getLocales(): ?array
    {
        return $this->locales;
    }

    public function setLocales(array $locales): self
    {
        $this->locales = $locales;

        return $this;
    }

    public function getMap(): ?array
    {
        return $this->map;
    }

    public function setMap(array $map): self
    {
        $this->map = $map;

        return $this;
    }

}
