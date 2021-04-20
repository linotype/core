<?php

namespace Linotype\Core\Render;

use DeepCopy\DeepCopy;
use Linotype\Core\Entity\LinotypeEntity;
use Linotype\Core\Entity\ModuleEntity;

class ModuleRender
{

    private $output;

    private $module;

    public function __construct(ModuleEntity $module, LinotypeEntity $linotype)
    {
        $this->linotype = $linotype;
        $this->module = $module;
        $this->blocks = $linotype->getBlocks();
    }

    public function render()
    {
        $this->output = [];
        foreach( $this->module->getLayout() as $item_key => $item ) {
            if ( isset( $item['block'] ) && $item['block'] !== "" ) {

                //clone block from defaults
                $block = (new DeepCopy())->copy( $this->blocks->findById($item['block']) );

                //create unique block key with module key reference 
                if( $this->module->getKey() ) $item_key = $this->module->getKey() . '__' . $item_key;

                //set block key
                $block->setKey($item_key);
              
                //set block custom title from map to display as fields section
                $block->setTitle( $item['title'] );

                //set block custom help from map to display as fields section
                $block->setHelp( $item['help'] );
                
                //set doctrine template ref id
                $block->setTemplateRef($this->module->getTemplateRef());

                if ( isset( $item['children'] ) && is_array( $item['children'] ) && ! empty( $item['children'] ) ) {
                    $block->setChildren( $this->renderChildren( $item['children'], $item_key ) );
                }

                //get blocks from the module
                $blockRender = new BlockRender( $block, $this->linotype );

                //add block to output
                $this->output[$block->getKey()] = $blockRender->render( $item['override'] );
            
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
            $block->setTemplateRef($this->module->getTemplateRef());

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
