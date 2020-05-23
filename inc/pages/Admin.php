<?php
/**
 * @package RonashPlugin
 */

namespace Inc\pages;


use Inc\base\BaseController;
use Inc\callbacks\AdminCallBacks;

class Admin extends BaseController{

    private $pages;

    private $subPages;

    public $callbackClass = AdminCallBacks::class;


    public function register(){

        $this->setPages();
        $this->setSubPages();
        $this->setCustomFields();
         $this->getSetting()
            ->addPages($this->pages)
            ->withSubpage('Dashboard')
            ->addSubPages($this->subPages)
            ->register();
    }

    private function setPages()
    {
        $this->pages  = [
            [
                'page_title'=>"Ronash Plugin",
                "menu_title"=>"Ronash",
                "capability"=>"manage_options",
                "callback"=>[$this->getCallBack(),'dashboard'],
                "menu_slug"=>"ronash_plugin",
                "icon_url"=>"dashicons-store",
                "position"=>110
            ]
        ];

        return $this;
    }

    private function setSubPages()
    {

        $this->subPages  = [

            [
                'parent_slug'=>"ronash_plugin",
                'page_title'=>"Lokesh Plugin",
                "menu_title"=>"Lokesh",
                "capability"=>"manage_options",
                "callback"=>[$this->getCallBack(),'lokesh'],
                "menu_slug"=>"lokesh_plugin",

            ]
        ];
        return $this;
    }

    /**
     * Fields API Sections
     * ==================
     */

    /**
     * Add Settings
     */
    private function setFieldsSettings()
    {
        $args = [
            [
                'option_group'=>'ronash_plugin_option_group',
                'option_name'=>'text_example',
                'callback'=>[$this->getCallBack(),'fieldsOptionGroup']
            ]
        ];
        $this->getSetting()->customFields()->addSettings($args);
    }
    /**
     * Add Sections
     */
    private function setFieldsSections()
    {
        $args = [
            [
                'id'=>'ronash_plugin_admin_index',
                'title'=>'Settings',
                'callback'=>[$this->getCallBack(),'fieldsSection'],
                'page'=>'ronash_plugin'
            ]
        ];
        $this->getSetting()->customFields()->addSections($args);
    }

    /**
     * Add Fields
     */
    private function setFieldsField()
    {
        $args = [
            [
                'id'=>'text_example',
                'title'=>'Text Example',
                'callback'=>[$this->getCallBack(),'fieldsFieldTextExample'],
                'page'=>'ronash_plugin',
                'section'=>'ronash_plugin_admin_index',
                'arg'=>[
                    'label_for'=>'text_example',
                    'class'=>'example_class'
                ]
            ]
        ];
        $this->getSetting()->customFields()->addFields($args);
    }

    /**
     * Set fields api args
     */
    private function setCustomFields()
    {
        $this->setFieldsSettings();
        $this->setFieldsSections();
        $this->setFieldsField();
    }

}