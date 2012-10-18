<?php

/**
 *  Class Base_Controller_Action
 *
 *  @author Willem Daems
 *  @package ThinkFW
 *  @subpackage Base
 *
 *
 */
class Base_Controller_Action
{

    public $view;
    protected $path;

    public function __construct()
    {
        $this->view = new Base_View;
    }

    public function setPath($path)
    {
        $this->view->path = $path;
    }

    public function getView()
    {
        return $this->view;
    }

    public function __destruct()
    {
        //$this->view->show();
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
        exit;
    }
}