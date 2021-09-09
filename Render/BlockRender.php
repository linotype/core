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
            if ( $contextItem->getPersist() == 'option' || $contextItem->getPersist() == 'both' ) {
                $option_value = null;
                $context_key = $this->block->getKey() . '__' . $contextItem->getId();
                try {
                    
                    //get default local value
                    $option_object = LinotypeCore::getDoctrine('repository','option')->findOneBy([ 'option_key' => $context_key ]);
                    $option_value = $option_object ? $option_object->getOptionValue() : null;

                    //if current locale is not default, check if translate exist and get value
                    $option_value_trans = null;
                    if ( LinotypeCore::getLocale() !== 'en' ) {
                        $option_object_trans = LinotypeCore::getDoctrine('repository','translate')->findOneBy([ 
                            'type' => 'option',
                            'trans_id' => $context_key,
                            'lang' => LinotypeCore::getLocale(),
                        ]);
                        $option_value_trans = $option_object_trans ? $option_object_trans->getTransValue() : null;
                    }

                } 
                catch(\Exception $e){
                    $e->getMessage();
                }
                if ( LinotypeCore::getLocale() !== 'en' ) {
                    if ( $option_value_trans ) {
                        $contextItem->setValue( $option_value_trans );
                    } else {
                        if ( $option_value ) $contextItem->setDefault( $option_value );
                    }
                } else {
                    if ( $option_value ) {
                        if ( $this->block->getTemplateRef() ) {
                            $contextItem->setDefault( $option_value );
                        } else {
                            $contextItem->setValue( $option_value );
                        }
                    }
                }
            }
            
            if ( $this->block->getTemplateRef() ) {
                if ( $contextItem->getPersist() == 'meta' || $contextItem->getPersist() == 'both' ) {
                    $meta_value = null;
                    $context_key = $this->block->getKey() . '__' . $contextItem->getId();
                    try {

                        //get default local value
                        $meta_object = LinotypeCore::getDoctrine('repository','meta')->findOneBy([ 'context_key' => $context_key, 'template_id' => $this->block->getTemplateRef() ]);
                        $meta_value = $meta_object ? $meta_object->getContextValue() : null;

                        //if current locale is not default, check if translate exist and get value
                        $meta_value_trans = null;
                        if ( LinotypeCore::getLocale() !== 'en' ) {
                            $meta_object_trans = LinotypeCore::getDoctrine('repository','translate')->findOneBy([ 
                                'type' => 'meta',
                                'context_key' => $context_key,
                                'template_id' => $this->block->getTemplateRef(),
                                'lang' => LinotypeCore::getLocale(),
                            ]);
                            $meta_value_trans = $meta_object_trans ? $meta_object_trans->getTransValue() : null;
                        }
                        
                    } 
                    catch(\Exception $e){
                        $e->getMessage();
                    }
                    if ( LinotypeCore::getLocale() !== 'en' ) {
                        if ( $meta_value_trans ) {
                            $contextItem->setValue( $meta_value_trans );
                        } else {
                            if ( $meta_value ) $contextItem->setDefault( $meta_value );
                        }
                    } else {
                        if( $meta_value ) {
                            $contextItem->setValue( $meta_value );
                        }
                    }
                }
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
                if ( $contextItem->getPersist() == 'meta' || $contextItem->getPersist() == 'option' || $contextItem->getPersist() == 'both' ) {

                    //clone field object
                    $field = (new DeepCopy())->copy( $this->fields->findById( $contextItem->getField() ) );

                    //set context key
                    $field->setKey( $this->block->getKey() . '__' . $contextItem->getId() );

                    //replace field title with context title
                    $field->setTitle( $contextItem->getName() );

                    //replace field description with context title
                    $field->setHelp( $contextItem->getDesc() );

                    //define field default value from default context (to use as placeholder)
                    $field->setDefault( $contextItem->getDefault() );

                    //override field option with context option 
                    $option = $field->getOption();
                    foreach ( $contextItem->getOption() as $option_key => $option_value ) {
                        $option[ $option_key ] = $option_value;
                    }
                    $field->setOption( $option );

                    //save option as css and js values
                    $field_js = [];
                    $field_css = [];
                    foreach( $field->getOption() as $option_key => $option_value ) {
                        $field_js[ $field->getCssId() ][ $option_key ] = $option_value;
                        if ( ! is_array( $option_value ) && ! is_object( $option_value ) ) $field_css[ '#' . $field->getCssId() ][ '--' . $option_key ] = $option_value;
                    }
                    $field->setCustomJs( $field_js );
                    $field->setCustomCss( $field_css );

                    //define field value with context dynamic value
                    if ( $contextItem->getValue() != $contextItem->getDefault() ) {
                        $field->setValue( $contextItem->getValue() );
                    }

                    //set field entity in block object
                    $contextItem->setFieldEntity( $field );
                }
            }
            
        }
        
        $this->block->setCustomJs( $js );
        $this->block->setCustomCss( $css );
        
        
        return $this->block;
    }

}
