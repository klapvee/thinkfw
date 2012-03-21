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
			$this->view->categories = $this->_model->getCategories($this->_db);
		}
	}