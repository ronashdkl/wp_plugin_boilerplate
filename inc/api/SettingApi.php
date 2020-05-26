<?php

/**
 * @package RonashPlugin
 */

namespace Inc\api;

/**
 * Class SettingApi
 * @package Inc\api
 */
class SettingApi
{

    private $adminPages = [];
    private $adminSubPages = [];
    private $fieldsApi;

    function __construct()
    {

        $this->fieldsApi = new FieldApi();

    }

    /**
     * Register
     */
    public function register()
    {
        if (!empty($this->adminPages) || !empty($this->adminSubPages)) {
            add_action('admin_menu', [$this, 'addAdminMenu']);

        }

        if(!empty($this->fieldsApi->verifySettings())){
              add_action('admin_init',[$this->fieldsApi,'registerCustomFields']);
        }

    }



    /**
     * @return FieldApi
     */
    public function customFields()
    {
        return $this->fieldsApi;
    }

    /**
     * @param array $pages
     * @return $this
     */
    public function addPages(array $pages)
    {
        $this->adminPages = $pages;
        return $this;
    }

    /**
     * @param string|null $title
     * @return $this
     */
    public function withSubpage(string $title = null)
    {
        if (empty($this->adminPages)) return $this;
        $this->adminSubPages = [
            [
                'parent_slug' => $this->adminPages[0]['menu_slug'],
                'page_title' => $this->adminPages[0]['page_title'],
                "menu_title" => $title??$this->adminPages[0]['menu_title'],
                "capability" => $this->adminPages[0]['capability'],
                "callback" => $this->adminPages[0]['callback'],
                "menu_slug" => $this->adminPages[0]['menu_slug']
            ]
        ];
        return $this;

    }

    /**
     * @param array $subPages
     * @return $this
     */
    public function addSubPages($subPages)
    {
        if(!$subPages) return $this;
        $this->adminSubPages = array_merge($this->adminSubPages ,$subPages);

        return $this;

    }

    /**
     * Add Admin menu.
     * @return void
     */
    public function addAdminMenu()
    {
        foreach ($this->adminPages as $page) {
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position']);
        }

        foreach ($this->adminSubPages as $page) {
            add_submenu_page($page['parent_slug'],$page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback']);
        }
    }

}