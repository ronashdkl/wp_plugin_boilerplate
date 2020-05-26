<?php
/**
 * @package RonashPlugin
 */

namespace Inc\base;

use Inc\callbacks\TaxonomyCallBacks;

class TaxonomyController extends BaseController
{
    private $subPages = [];
    protected $callbackClass = TaxonomyCallBacks::class;

    public function register()
    {
       $activated =  Manager::isActive(Manager::TAXONOMY_MANAGER);

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
                'page_title' => "Taxonomy",
                "menu_title" => "Taxonomy Manager",
                "capability" => "manage_options",
                "callback" => [$this->getCallBack(), 'view'],
                "menu_slug" => $this->generateName("taxonomy"),

            ];
        } catch (\ErrorException $e) {
        }


        return $this;
    }

}