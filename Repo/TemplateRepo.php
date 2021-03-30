<?php

namespace Linotype\Core\Repo;

use Linotype\Core\Entity\TemplateEntity;

class TemplateRepo
{

    private $dir;

    private $path;
    
    private $templates;

    public function findById($id): ?TemplateEntity
    {   
        return isset( $this->templates[$id] ) ? $this->templates[$id] : null;
    }

    public function findByAuthor($author): ?array
    {   
        $templatesByAuthor = [];
        foreach( $this->templates as $template ) {
            if ( $template->getAuthor() == $author ) {
                $templatesByAuthor[ $template->getId() ] = $template;
            }
        }
        return $templatesByAuthor;
    }

    public function getTemplates(): ?self
    {
        return $this->templates;
    }

    public function getTemplate($id): ?TemplateEntity
    {
        return isset( $this->templates[$id] ) ? $this->templates[$id] : null;
    }

    public function addTemplate(TemplateEntity $template): self
    {
        $this->templates[$template->getId()] = $template;

        return $this;
    }
    
}
