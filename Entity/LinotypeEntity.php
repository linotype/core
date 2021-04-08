<?php

namespace Linotype\Core\Entity;

use Linotype\Core\Repo\BlockRepo;
use Linotype\Core\Repo\FieldRepo;
use Linotype\Core\Repo\HelperRepo;
use Linotype\Core\Repo\ModuleRepo;
use Linotype\Core\Repo\TemplateRepo;
use Linotype\Core\Repo\ThemeRepo;
use Linotype\Core\Builder\ActiveBuilder;
use Linotype\Core\Builder\CurrentBuilder;

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

    public function getHelpers(): ?HelperRepo
    {
        return $this->helpers;
    }

    public function setHelpers(HelperRepo $helpers): self
    {
        $this->helpers = $helpers;

        return $this;
    }

    public function getModules(): ?ModuleRepo
    {
        return $this->modules;
    }

    public function setModules(ModuleRepo $modules): self
    {
        $this->modules = $modules;

        return $this;
    }

    public function getTemplates(): ?TemplateRepo
    {
        return $this->templates;
    }

    public function setTemplates(TemplateRepo $templates): self
    {
        $this->templates = $templates;

        return $this;
    }

    public function getThemes(): ?ThemeRepo
    {
        return $this->themes;
    }

    public function setThemes(ThemeRepo $themes): self
    {
        $this->themes = $themes;

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
