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
        foreach( $this->module->getLayout() as $item_id => $item ) {
            if ( isset( $item['block'] ) && $item['block'] !== "" ) {

                //clone block from defaults
                $block = (new DeepCopy())->copy( $this->blocks->findById($item['block']) );

                //create unique block key with module key reference 
                if( $this->module->getKey() ) $item_id = $this->module->getKey() . '__' . $item_id;

                //set block key
                $block->setKey($item_id);
              
                //get blocks from the module
                $blockRender = new BlockRender( $block, $this->linotype );

                //add block to output
                $this->output[$block->getKey()] = $blockRender->render( $item['override'] );
            
            }
        }
        return $this->output;
    }

}
