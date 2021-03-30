<?php

namespace Linotype\Core\Config;

use Linotype\Core\Builder\ActiveBuilder;
use Linotype\Core\Builder\CurrentBuilder;

class LinotypeConfig
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

    public function getBlocks(): ?array
    {
        return $this->blocks;
    }

    public function getBlock(string $id = null): ?BlockConfig
    {
        return isset( $this->blocks[$id] ) ? $this->blocks[$id] : null;
    }

    public function addBlock(BlockConfig $block): self
    {
        $this->blocks[ $block->getId() ] = $block;

        return $this;
    }

    public function getFields(): ?array
    {
        return $this->fields;
    }

    public function getField(string $id = null): ?FieldConfig
    {
        return isset( $this->fields[$id] ) ? $this->fields[$id] : null;
    }

    public function addField(FieldConfig $field): self
    {
        $this->fields[ $field->getId() ] = $field;

        return $this;
    }

    public function getHelpers(): ?array
    {
        return $this->helpers;
    }

    public function getHelper(string $id = null): ?HelperConfig
    {
        return isset( $this->helpers[$id] ) ? $this->helpers[$id] : null;
    }

    public function addHelper(HelperConfig $helper): self
    {
        $this->helpers[ $helper->getId() ] = $helper;

        return $this;
    }

    public function getModules(): ?array
    {
        return $this->modules;
    }

    public function getModule(string $id = null): ?ModuleConfig
    {
        return isset( $this->modules[$id] ) ? $this->modules[$id] : null;
    }

    public function addModule(ModuleConfig $module): self
    {
        $this->modules[ $module->getId() ] = $module;

        return $this;
    }

    public function getTemplates(): ?array
    {
        return $this->templates;
    }

    public function getTemplate(string $id = null): ?TemplateConfig
    {
        return isset( $this->templates[$id] ) ? $this->templates[$id] : null;
    }

    public function addTemplate(TemplateConfig $template): self
    {
        $this->templates[ $template->getId() ] = $template;

        return $this;
    }

    public function getThemes(): ?array
    {
        return $this->themes;
    }

    public function getTheme(string $id = null): ?ThemeConfig
    {   
        return isset( $this->themes[$id] ) ? $this->themes[$id] : null;
    }

    public function addTheme(ThemeConfig $theme): self
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
