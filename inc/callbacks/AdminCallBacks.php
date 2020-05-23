<?php


namespace Inc\callbacks;

use Inc\base\BaseController;

/**
 * Class AdminCallBacks
 * @package RonashPlugin
 */
class AdminCallBacks extends BaseController
{
    public function dashboard()
    {
    return  $this->render('admin/dashboard');
    }

    public function manager($args)
    {

        var_dump($args);
       // return  $this->render("admin/$manager");
 }

    /**
     * Field Api Sections
     * =================
     */


    /**
     * @return string
     */
    public function fieldsSection()
    {
        echo  'Turn on/off Managers';
        return;
    }

}