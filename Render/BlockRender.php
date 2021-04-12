<?php

namespace Linotype\Core\Render;

use DeepCopy\DeepCopy;
use Linotype\Core\Context\BlockContext;
use Linotype\Core\Context\BlockContextItem;
use Linotype\Core\Entity\LinotypeEntity;
use Linotype\Core\Entity\BlockEntity;
use Linotype\Core\LinotypeCore;

class BlockRender
{

    private $output;

    private $block;

    public function __construct(BlockEntity $block, LinotypeEntity $linotype )
    {
        $this->block = $block;
        $this->blocks = $linotype->getBlocks();
        $this->fields = $linotype->getFields();
    }

    public function render($override = [])
    {
        
        $js = [];
        $css = [];

        foreach( $this->block->getContext()->getAll() as $contextKey => $contextItem ) 
        {    
            
            //get override value
            if ( isset( $override[ $contextItem->getId() ] ) && $override[ $contextItem->getId() ] )  {
                if ( isset( $override[ $contextItem->getId() ] ) ) {
                    foreach( $override[ $contextItem->getId() ] as $override_id => $override_value ) {
                        switch ( $override_id ) {
                            case 'name':
                            case 'title':
                                $contextItem->setName($override_value);
                            break;
                            case 'desc':
                            case 'helper':
                                $contextItem->setDesc($override_value);
                            break;
                            case 'field':
                                $contextItem->setField($override_value);
                            break;
                            case 'option':
                                $contextItem->setOption($override_value);
                            break;
                            case 'persist':
                                $contextItem->setPersist($override_value);
                            break;
                            case 'value':
                                $contextItem->setValue($override_value);
                            break;
                            case 'default':
                                $contextItem->setDefault($override_value);
                            break;
                            case 'preview':
                                $contextItem->setPreview($override_value);
                            break;
                            case 'format':
                                $contextItem->setFormat($override_value);
                            break;
                            case 'debug':
                                $contextItem->setDebug($override_value);
                            break;
                            case 'js':
                                $contextItem->setJs($override_value);
                            break;
                            case 'css':
                                $contextItem->setCss($override_value);
                            break;
                        }
                    }
                    
                }
            }
            
            //get persist value
            if ( $contextItem->getPersist() == 'meta' ) {
                $meta_value = null;
                $context_key = $this->block->getKey() . '__' . $contextItem->getId();
                try {
                    $meta_object = LinotypeCore::getDoctrine('repository','meta')->findOneBy([ 'context_key' => $context_key, 'template_id' => $this->block->getTemplateRef() ]);
                    $meta_value = $meta_object ? $meta_object->getContextValue() : null;
                } 
                catch(\Exception $e){
                    $e->getMessage();
                }
                if ( $meta_value ) $contextItem->setValue( $meta_value );
            }


            //create custom js variable
            if ( $contextItem->getValue() && $contextItem->getJs() ) {
                if ( ! isset( $js[ '#' . $this->block->getCssId() ] ) ) $js[ $this->block->getCssId() ] = [];
                $js[ $this->block->getCssId() ][ $contextKey ] = $contextItem->getValue();
            }

            //create custom css variable
            if ( $contextItem->getValue() && $contextItem->getCss() ) {
                if ( ! isset( $css[ '#' . $this->block->getCssId() ] ) ) $css[ '#' . $this->block->getCssId() ] = [];
                $css[ '#' . $this->block->getCssId() ][ '--' . $contextKey ] = $contextItem->getValue();
            }

            //set field and override title, help, require and options
            if ( $contextItem->getField() ) {
                if ( $contextItem->getPersist() == 'meta' ) {
                    $field = (new DeepCopy())->copy( $this->fields->findById( $contextItem->getField() ) );
                    $field->setKey( $this->block->getKey() . '__' . $contextItem->getId() );
                    $field->setTitle( $contextItem->getName() );
                    $field->setHelp( $contextItem->getDesc() );
                    if ( $contextItem->getValue() != $contextItem->getDefault() ) {
                        $field->setValue( $contextItem->getValue() );
                    }
                    $contextItem->setFieldEntity( $field );
                }
            }
            
        }
        
        $this->block->setCustomJs( $js );
        $this->block->setCustomCss( $css );
        
        
        return $this->block;
    }

}
