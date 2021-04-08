<?php

namespace Linotype\Core\Helper;

class InfoHelper
{
    
    private $dir;
    
    private $path;

    private $template;
    
    private $script;

    private $style;
    
    public function __construct( $type, $id, $dir )
    {
        $this->dir = $dir . '/' . $id;
        switch($type){
            case 'block':
                $this->path = str_replace( dirname( dirname( $dir ) ), '', $dir ) . '/' . $id;
                $this->template = str_replace( dirname( $dir ), '', $dir ) . '/' . $id . '/' . $id . '.twig';
                $this->script = str_replace( dirname( $dir ), '', $dir ) . '/' . $id . '/' . $id . '.js';
                $this->style = str_replace( dirname( $dir ), '', $dir ) . '/' . $id . '/' . $id . '.scss';
            break;
            case 'field':
                $this->path = str_replace( dirname( dirname( $dir ) ), '', $dir ) . '/' . $id;
                $this->template = str_replace( dirname( $dir ), '', $dir ) . '/' . $id . '/' . $id . '.twig';
                $this->script = str_replace( dirname( $dir ), '', $dir ) . '/' . $id . '/' . $id . '.js';
                $this->style = str_replace( dirname( $dir ), '', $dir ) . '/' . $id . '/' . $id . '.scss';
            break;
            case 'helper':
                $this->path = str_replace( dirname( dirname( $dir ) ), '', $dir ) . '/' . $id;
            break;
            case 'module':
                $this->path = str_replace( dirname( dirname( $dir ) ), '', $dir ) . '/' . $id;
            break;
            case 'template':
                $this->path = str_replace( dirname( dirname( $dir ) ), '', $dir ) . '/' . $id;
            break;
            case 'theme':
                $this->path = str_replace( dirname( dirname( $dir ) ), '', $dir ) . '/' . $id;
                $this->template = str_replace( dirname( $dir ), '', $dir ) . '/' . $id . '/index.twig';
                $this->script = str_replace( dirname( $dir ), '', $dir ) . '/' . $id . '/assets/js/frontend.js';
                $this->style = str_replace( dirname( $dir ), '', $dir ) . '/' . $id . '/assets/js/frontend.scss';
            break;
        }
        
        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getDir(): ?string
    {
        return $this->dir;
    }

    public function setDir(string $dir): self
    {
        $this->dir = $dir;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getScript(): ?string
    {
        return $this->script;
    }

    public function setScript(string $script): self
    {
        $this->script = $script;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(string $style): self
    {
        $this->style = $style;

        return $this;
    }

}