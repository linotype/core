<?php

namespace Linotype\Core\Entity;

use Linotype\Core\Builder\ActiveBuilder;
use Linotype\Core\Builder\CurrentBuilder;
use Linotype\Core\Repo\BlockRepo;
use Linotype\Core\Repo\FieldRepo;

class LinotypeEntity
{

    private $version;

    private $debug;

    private $preview;

    private $theme;

    private $blocks;

    private $fields;
    
    private $helpers;
    
    private $modules;
    
    private $templates;
    
    private $themes;

    private $active;

    private $current;

    public function getVersion(): ?float
    {
        return $this->version;
    }

    public function setVersion(float $version): self
    {
        $this->version = $version;

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

    public function getPreview(): ?bool
    {
        return $this->preview;
    }

    public function setPreview(bool $preview): self
    {
        $this->preview = $preview;

        return $this;
    }

    public function getActiveTheme(): ?string
    {
        return $this->theme;
    }

    public function setActiveTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getBlocks(): ?BlockRepo
    {
        return $this->blocks;
    }

    public function setBlocks(BlockRepo $blocks): self
    {
        $this->blocks = $blocks;

        return $this;
    }

    public function getFields(): ?FieldRepo
    {
        return $this->fields;
    }

    public function setFields(FieldRepo $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    public function getHelpers(): ?array
    {
        return $this->helpers;
    }

    public function getHelper(string $id = null): ?HelperEntity
    {
        return isset( $this->helpers[$id] ) ? $this->helpers[$id] : null;
    }

    public function addHelper(HelperEntity $helper): self
    {
        $this->helpers[ $helper->getId() ] = $helper;

        return $this;
    }

    public function getModules(): ?array
    {
        return $this->modules;
    }

    public function getModule(string $id = null): ?ModuleEntity
    {
        return isset( $this->modules[$id] ) ? $this->modules[$id] : null;
    }

    public function addModule(ModuleEntity $module): self
    {
        $this->modules[ $module->getId() ] = $module;

        return $this;
    }

    public function getTemplates(): ?array
    {
        return $this->templates;
    }

    public function getTemplate(string $id = null): ?TemplateEntity
    {
        return isset( $this->templates[$id] ) ? $this->templates[$id] : null;
    }

    public function addTemplate(TemplateEntity $template): self
    {
        $this->templates[ $template->getId() ] = $template;

        return $this;
    }

    public function getThemes(): ?array
    {
        return $this->themes;
    }

    public function getTheme(string $id = null): ?ThemeEntity
    {   
        return isset( $this->themes[$id] ) ? $this->themes[$id] : null;
    }

    public function addTheme(ThemeEntity $theme): self
    {
        $this->themes[ $theme->getId() ] = $theme;

        return $this;
    }

    public function getActive(): ?ActiveBuilder
    {   
        return $this->active;
    }

    public function setActive(ActiveBuilder $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCurrent(): ?CurrentBuilder
    {   
        return $this->current;
    }

    public function setCurrent(CurrentBuilder $current): self
    {
        $this->current = $current;

        return $this;
    }


}
