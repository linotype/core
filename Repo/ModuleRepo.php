<?php

namespace Linotype\Core\Repo;

use Linotype\Core\Entity\ModuleEntity;

class ModuleRepo
{

    private $dir;

    private $path;
    
    private $modules;

    public function findById($id): ?ModuleEntity
    {   
        return isset( $this->modules[$id] ) ? $this->modules[$id] : null;
    }

    public function findBySlug($slug): ?ModuleEntity
    {   
        foreach( $this->modules as $module ) {
            if ( $module->getSlug() == $slug ) {
                return $module;
            }
        }
        return null;
    }

    public function findByAuthor($author): ?array
    {   
        $modulesByAuthor = [];
        foreach( $this->modules as $module ) {
            if ( $module->getAuthor() == $author ) {
                $modulesByAuthor[ $module->getId() ] = $module;
            }
        }
        return $modulesByAuthor;
    }

    public function getAll(): ?array
    {
        return $this->modules;
    }

    public function getModule($id): ?ModuleEntity
    {
        return isset( $this->modules[$id] ) ? $this->modules[$id] : null;
    }

    public function addModule(ModuleEntity $module): self
    {
        $this->modules[$module->getId()] = $module;

        return $this;
    }
    
}
