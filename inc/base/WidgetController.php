<?php
/**
 * @package RonashPlugin
 */

namespace Inc\base;

use Inc\callbacks\WidgetCallBacks;

class WidgetController extends BaseController
{
    private $subPages = [];
    protected $callbackClass = WidgetCallBacks::class;

    public function register()
    {
       $activated =  Manager::isActive(Manager::WIDGET_MANAGER);

       if(!$activated){
           return;
       }

        try {
            $this->setSubPages()->getSetting()->addSubPages($this->subPages)->register();
        } catch (\ErrorException $e) {
        }


    }

    private function setSubPages()
    {
        try {
            $this->subPages[] = [
                'parent_slug' =>self::PLUGIN_NAME,
                'page_title' => "Widget",
                "menu_title" => "Widget Manager",
                "capability" => "manage_options",
                "callback" => [$this->getCallBack(), 'view'],
                "menu_slug" => $this->generateName("widget"),

            ];
        } catch (\ErrorException $e) {
        }


        return $this;
    }

}