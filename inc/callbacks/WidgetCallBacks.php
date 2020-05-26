<?php


namespace Inc\callbacks;


use Inc\base\BaseController;

class WidgetCallBacks extends BaseController
{
    public function view()
    {
        return $this->render('admin/widget');
    }
}