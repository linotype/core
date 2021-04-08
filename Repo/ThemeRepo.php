<?php

namespace Linotype\Core\Repo;

use Linotype\Core\Entity\ThemeEntity;

class ThemeRepo
{

    private $dir;

    private $path;
    
    private $themes;

    public function findById($id): ?ThemeEntity
    {   
        return isset( $this->themes[$id] ) ? $this->themes[$id] : null;
    }

    public function findBySlug($slug): ?ThemeEntity
    {   
        foreach( $this->themes as $theme ) {
            if ( $theme->getSlug() == $slug ) {
                return $theme;
            }
        }
        return null;
    }

    public function findByAuthor($author): ?array
    {   
        $themesByAuthor = [];
        foreach( $this->themes as $theme ) {
            if ( $theme->getAuthor() == $author ) {
                $themesByAuthor[ $theme->getId() ] = $theme;
            }
        }
        return $themesByAuthor;
    }

    public function getAll(): ?array
    {
        return $this->themes;
    }

    public function getTheme($id): ?ThemeEntity
    {
        return isset( $this->themes[$id] ) ? $this->themes[$id] : null;
    }

    public function addTheme(ThemeEntity $theme): self
    {
        $this->themes[$theme->getId()] = $theme;

        return $this;
    }
    
}
