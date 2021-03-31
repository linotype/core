<?php

namespace Linotype\Core\Render;

use Linotype\Core\Entity\LinotypeEntity;

class TemplateRender
{

    private $output;

    private $template;

    public function __construct(string $template_id, LinotypeEntity $linotype)
    {
        $this->linotype = $linotype;
        $this->template = $linotype->getTemplates()->getTemplate($template_id);
        $this->modules = $linotype->getModules();
        $this->blocks = $linotype->getBlocks();
    }

    public function render()
    {
        $this->output = [];
        foreach( $this->template->getLayout() as $item_key => $item ) {
            if ( isset( $item['module'] ) && $item['module'] !== "" ) {

                //clone module from defaults
                $module = clone $this->modules->findById($item['module']);
                
                //set unique module key
                $module->setKey($item_key);

                //get blocks from the module
                $moduleRender = new ModuleRender( $module, $this->linotype );

                //add each block to output
                foreach( $moduleRender->render() as $module_item_key => $module_item ) {
                    $this->output[$module_item->getKey()] = $module_item;
                }
                
            } else if ( isset( $item['block'] ) && $item['block'] !== "" ) {
            
                //clone block from defaults
                $block = clone $this->blocks->findById($item['block']);
                
                //set unique module key
                $block->setKey($item_key);

                //add block to output
                $this->output[$item_key] = $block;
            
            }
        }
        return $this->output;
    }

}
