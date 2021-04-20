<?php

namespace Linotype\Core\Render;

use DeepCopy\DeepCopy;
use Linotype\Core\Entity\LinotypeEntity;
use Linotype\Core\Entity\TemplateEntity;
use Linotype\Core\LinotypeCore;

class TemplateRender
{

    private $output;

    private $template;

    public function __construct( LinotypeEntity $linotype)
    {
        $this->linotype = $linotype;
        $this->templates = $linotype->getTemplates();
        $this->modules = $linotype->getModules();
        $this->blocks = $linotype->getBlocks();
    }

    public function render(TemplateEntity $template)
    {
        $this->template = $template;
        
        //set doctrine database ref if exist
        $templateEntityExist = LinotypeCore::getDoctrine('repository','template')->findOneBy(['template_key' => $this->template->getKey() ]);
        if ( $templateEntityExist ) $this->template->setTemplateRef( $templateEntityExist->getId() );

        $this->output = [];
        foreach( $this->template->getLayout() as $item_key => $item ) {

            if ( isset( $item['module'] ) && $item['module'] !== "" ) {

                //clone module from defaults
                $module = (new DeepCopy())->copy( $this->modules->findById($item['module']) );
                
                //set unique module key
                $module->setKey($item_key);

                //set doctrine template ref id
                $module->setTemplateRef($this->template->getTemplateRef());

                //get blocks from the module
                $moduleRender = new ModuleRender( $module, $this->linotype );

                //add each block to output
                foreach( $moduleRender->render() as $module_item_key => $module_item ) {
                    $this->output[$module_item->getKey()] = $module_item;
                }
                
            } else if ( isset( $item['block'] ) && $item['block'] !== "" ) {
            
                //clone block from defaults
                $block = (new DeepCopy())->copy( $this->blocks->findById($item['block']) );
                
                //set unique module key
                $block->setKey($item_key);

                //set block custom title from map to display as fields section
                $block->setTitle( $item['title'] );

                //set block custom help from map to display as fields section
                $block->setHelp( $item['help'] );

                //set doctrine template ref id
                $block->setTemplateRef($this->template->getTemplateRef());

                if ( isset( $item['children'] ) && is_array( $item['children'] ) && ! empty( $item['children'] ) ) {
                    $block->setChildren( $this->renderChildren( $item['children'], $item_key ) );
                }

                //get blocks from the module
                $blockRender = new BlockRender( $block, $this->linotype );

                //add block to output
                $this->output[$item_key] = $blockRender->render( $item['override'] );
            
            }
        }
        
        return $this->output;
    }

    public function renderChildren($children, $deep_key)
    {
        $output = [];
        foreach( $children as $child_key => $child ) {
            
            $block = (new DeepCopy())->copy( $this->blocks->findById($child['block']) );

            //set unique module key
            $block->setKey($deep_key . '--' . $child_key);
            
            //set doctrine template ref id
            $block->setTemplateRef($this->template->getTemplateRef());

            //get blocks from the module
            $blockRender = new BlockRender( $block, $this->linotype );

            if ( isset( $child['children'] ) && is_array( $child['children'] ) && ! empty( $child['children'] ) ) {
                $block->setChildren( $this->renderChildren( $child['children'], $deep_key . '--' . $child_key ) );
            }

            //add block to output
            $output[ $deep_key . '--' . $child_key ] = $blockRender->render( isset( $child['override'] ) ? $child['override'] : [] );
        
        }
        
        return $output;
    }

}
