<?php
/**
 * @package RonashPlugin
 */

namespace Inc\pages;


use Inc\base\BaseController;
use Inc\callbacks\AdminCallBacks;
use Inc\callbacks\forms\SanitizerCallBack;

class Admin extends BaseController
{

    private $pages;

    private $subPages;

    public $callbackClass = AdminCallBacks::class;
    private $callback_sanitize;


    public function __construct()
    {
        parent::__construct();
        $this->callback_sanitize = new SanitizerCallBack();
    }

    public function register()
    {

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
        $this->pages = [
            [
                'page_title' => "Ronash Plugin",
                "menu_title" => "Ronash",
                "capability" => "manage_options",
                "callback" => [$this->getCallBack(), 'dashboard'],
                "menu_slug" => "ronash_plugin",
                "icon_url" => "dashicons-store",
                "position" => 110
            ]
        ];

        return $this;
    }

    private function setSubPages()
    {
        $this->subPages = [];
        foreach ($this->managers as $key => $manager){
            if(get_option($key)){
                $this->subPages[] =   [
                    'parent_slug' => "ronash_plugin",
                    'page_title' => $manager,
                    "menu_title" => $manager,
                    "capability" => "manage_options",
                    "callback" =>[$this->getCallBack(), 'manager'],
                    "menu_slug" => $key,

                ];
            }

        }

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
        $args = [];

        foreach ($this->managers as $key => $manager){
            $args[] =  [
                'option_group' => 'ronash_plugin_settings',
                'option_name' => $key,
                'callback' => [$this->callback_sanitize, 'checkboxSanitize']
            ];
        }

        $this->getSetting()->customFields()->addSettings($args);
    }

    /**
     * Add Sections
     */
    private function setFieldsSections()
    {
        $args = [
            [
                'id' => 'ronash_plugin_admin_index',
                'title' => 'Settings Manager',
                'callback' => [$this->getCallBack(), 'fieldsSection'],
                'page' => 'ronash_plugin'
            ]
        ];
        $this->getSetting()->customFields()->addSections($args);
    }

    /**
     * Add Fields
     */
    private function setFieldsField()
    {
        $args = [];
        foreach ($this->managers as $key=>$value){
            $args[] =  [
                'id' => $key,
                'title' => $value,
                'callback' => [$this->callback_sanitize, 'checkboxField'],
                'page' => 'ronash_plugin',
                'section' => 'ronash_plugin_admin_index',
                'args' => [
                    'label_for' => $key,
                    'class' => 'ui-toggle'
                ]
            ];
        }

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