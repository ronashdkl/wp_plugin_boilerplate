<?php

/**
 * @package RonashPlugin
 */


namespace Inc\base;


use Inc\api\FieldApi;
use Inc\api\SettingApi;

/**
 * Class BaseController
 * @property string $plugin_path
 * @property string $plugin_url
 * @property string $plugin
 * @property string $callbackClass
 * @package Inc\base
 */
class BaseController
{
    protected $plugin_path;
    protected $plugin_url;
    protected $plugin;
    public $callbackClass;
    private $callBack;
    public $settingClass = SettingApi::class;
    private $settingApi;
    public $managers = [
        'cpt_manager'=>'CPT',
        'taxonomy_manager'=>'Taxonomy',
        'widget_manager'=>'Widget',
        'media_manager'=>'Media',
        'gallery_manager'=>'Gallery',
        'testimonial_manager'=>'Testimonial',
        'templates_manager'=>'Template',
        'login_manager'=>'Login',
        'membership_manager'=>'Membership',
        'chat_manager'=>'Chat'

    ];

    /**
     * BaseController constructor.
     */
    function __construct()
    {
        $this->init();
    }


    /**
     * Initialize controller
     */
    private function init()
    {
        $this->plugin_path = plugin_dir_path(dirname(__FILE__, 2));
        $this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));
        $this->plugin = plugin_basename(dirname(__FILE__, 3)) . "/ronash-plugin.php";
        if ($this->callbackClass!=null) $this->callBack =  new $this->callbackClass();
        if ($this->settingClass!=null) $this->settingApi =  new $this->settingClass();

    }

    /**
     * @return SettingApi
     */
    public function getSetting()
    {

         return $this->settingApi;

    }


    /**
     * @return SettingApi
     * @throws \ErrorException
     */
    public function getCallBack()
    {
        if ($this->callbackClass) return $this->callBack;
        else throw  new \ErrorException("callback class is not declared in " . get_called_class());
    }

    /**
     * @param $viewFile
     * @return mixed
     */
    public function render($viewFile)
    {
        if (strpos($viewFile, '.php') !== false) {
            $viewFile = str_replace('.php', '', $viewFile);
        }

        return require_once "$this->plugin_path/templates/$viewFile.php";
    }
}
