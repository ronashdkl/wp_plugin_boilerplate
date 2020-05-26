<?php


namespace Inc\callbacks;


use Inc\base\BaseController;

class TaxonomyCallBacks extends BaseController
{
    public function view()
    {
        return $this->render('admin/taxonomy');
    }
}