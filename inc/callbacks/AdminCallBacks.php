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

    public function lokesh()
    {
        return  $this->render('admin/lokesh');

    }


    /**
     * Field Api Sections
     * =================
     */

    /**
     * @param $input
     * @return mixed
     */
    public function fieldsOptionGroup($input)
    {
        return $input;
    }

    /**
     * @return string
     */
    public function fieldsSection()
    {
        echo  'check this beautiful section';
        return;
    }

    /**
     * @return mixed
     */
    public function fieldsFieldTextExample()
    {
        return $this->render('admin/fields_textExample');
    }/**
     * @return mixed
     */
    public function fieldsFieldTextExample1()
    {
        return $this->render('admin/fields_textExample');
    }
}