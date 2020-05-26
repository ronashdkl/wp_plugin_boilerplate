<?php
/**
 * @package RonashPlugin
 */

namespace Inc\pages;


use Inc\base\BaseController;
use Inc\base\Manager;
use Inc\callbacks\forms\ManagerCallBack;

class Dashboard extends BaseController
{

    private $pages;


    protected $callbackClass = ManagerCallBack::class;



    public function __construct()
    {
        parent::__construct();

    }

    public function register()
    {

        $this->setPages();

        try {
            $this->setCustomFields();
            $this->getSetting()
                ->addPages($this->pages)
                ->withSubpage('Dashboard')
                ->register();
        } catch (\ErrorException $e) {
        }
    }

    public function view()
    {
        return  $this->render('admin/dashboard');
    }

    private function setPages()
    {
        $this->pages = [
            [
                'page_title' => "Ronash Plugin",
                "menu_title" => "Ronash",
                "capability" => "manage_options",
                "callback" => [$this, 'view'],
                "menu_slug" => self::PLUGIN_NAME,
                "icon_url" => "dashicons-store",
                "position" => 110
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
     * @throws \ErrorException
     */
    private function setFieldsSettings()
    {
        $args = [[
            'option_group' => $this->generateName('plugin_settings'),
            'option_name' => self::PLUGIN_NAME,
            'callback' => [$this->getCallBack(), 'checkboxSanitize']
        ]];


        $this->getSetting()->customFields()->addSettings($args);
    }

    /**
     * Add Sections
     * @throws \ErrorException
     */
    private function setFieldsSections()
    {
        $args = [
            [
                'id' =>$this->generateName('plugin_admin_index'),
                'title' => 'Settings Manager',
                'callback' => [$this->getCallBack(), 'fieldsSection'],
                'page' => self::PLUGIN_NAME
            ]
        ];
        $this->getSetting()->customFields()->addSections($args);
    }

    /**
     * Add Fields
     * @throws \ErrorException
     */
    private function setFieldsField()
    {
        $args = [];
        foreach (Manager::$list as $key=>$value){
            $args[] =  [
                'id' => $key,
                'title' => $value,
                'callback' => [$this->getCallBack(), 'checkboxField'],
                'page' => self::PLUGIN_NAME,
                'section' =>$this->generateName('plugin_admin_index'),
                'args' => [
                    'option_name'=> self::PLUGIN_NAME,
                    'label_for' => $key,
                    'class' => 'ui-toggle'
                ]
            ];
        }

        $this->getSetting()->customFields()->addFields($args);
    }

    /**
     * Set fields api args
     * @throws \ErrorException
     */
    private function setCustomFields()
    {
        $this->setFieldsSettings();
        $this->setFieldsSections();
        $this->setFieldsField();
    }

}