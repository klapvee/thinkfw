<?php

/**
 *  Class Base_View
 *
 *  @package ThinkFW
 *  @subpackage Base
 *  @author Willem Daems
 *
 */
class Base_View
{

    /**
        *
        * @var string
        */
    private $layout;

    /**
        *
        * @var string
        */
    private $view;

    /**
        *
        * @var string
        */
    private $renderView;

    /**
        *
        * @var string
        */
    public $content;

    /**
        *
        * @var string
        */
    public $path;

    /**
        *
        * @var string
        */
    public $frontController;

    /**
        *
        * @var string
        */
    public $pageTitle;

    /**
        *
        * @var string
        */
    public $contentBottom;

    /**
        *
        * @var string
        */
    public $contentSidebar;


    public function __construct()
    {
        $this->renderView = true;
        $this->layout = 'layout.phtml';
    }

    public function getView()
    {

    }

    /**
        *
        * Push content in the sidebar
        *
        * @param type $content
        * @return void
        */
    public function setSidebar($content)
    {
        $this->contentSidebar .= $content;
    }

    /**
        *
        * @param type $content
        * @return void
        */
    public function setBottom($content)
    {
        $this->contentBottom .= $content;
    }

    /**
        *
        * @param string $title
        * @return void
        */
    public function setPageTitle($title)
    {
        $this->pageTitle = $title;
    }

    /**
        *
        * @param Base_Controller_Action $controller
        * @return void
        */
    public function setFrontController($controller)
    {
        $this->frontController = $controller;
    }

    /**
        *
        * @return Base_Controller_Action
        */
    public function getFrontController()
    {
        return $this->frontController;
    }

    public function getLayout()
    {
        if (!$this->renderView) return;
        require APPLICATION_PATH . '/layouts/' . $this->layout;
    }

    public function pageTitle()
    {
        return $this->pageTitle;
    }

    public function content()
    {
        if (!$this->renderView) return;
        $dir = empty( $this->path[1]) ? 'index' : $this->path[1];

        if (empty($this->view))
        {
            $file = empty( $this->path[2]) ? 'index' : $this->path[2];
        } else {
            $file = $this->view;
        }

        if (is_file(APPLICATION_PATH . '/views/html/'.$dir . '/' . $file . '.phtml'))
        {
            require APPLICATION_PATH . '/views/html/'.$dir . '/' . $file . '.phtml';
        }
    }

    public function bottom()
    {
        return $this->contentBottom;
    }

    public function sidebar()
    {
        return $this->contentSidebar;
    }

    public function render()
    {
        if (file_exists(APPLICATION_PATH . '/views/html/' . $this->view)) {

            ob_start();

            require APPLICATION_PATH . '/views/html/' . $this->view;
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        } else {
            echo 'view not found';
        }
    }

    public function setView($view)
    {
        $this->view = $view;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function setRender($render)
    {
        $this->renderView = $render;
    }

    public function show()
    {

        $this->getLayout();
    }

    public function __isset($name)
    {

    }

    public function __set($key, $value)
    {
        $this->$key = $value;
    }
}