<?php

    class IndexController extends Base_Controller_Action
    {
        private $_model;
        private $_db;

        public function init()
        {
            if (!isset($_SESSION['user']))
            {
                    Base_Application::redirect("/login");
            }

            $this->_model = new Model_Index;
            $this->_db = Base_Application::getDatabase();
        }

        public function indexAction()
        {
            /*
             * sample code rendering view
             * 
             * $divider = new Base_View;
             * $divider->setView('index/divider.phtml');
             * $divider->pages = $count / $this->_limit;
             * $divider->active = $this->_page;
             * $divider->limit = $this->_limit;
             * 
             * $content = $divider->render();
             *
             */
        }
    }