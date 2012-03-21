<?php

	/**
	 * Description of LoginController
	 *
	 * @author willem
	 */

	class LoginController extends Base_Controller_Action
	{
		private $_model;
		private $_db;
		
		public function init()
		{
			$this->_model = new Model_Login;
			$this->_db = Base_Application::getDatabase();
		}
		
		public function indexAction()
		{
			$this->getView()->setLayout('login.phtml');
			
			if (isset($_POST['username']))
			{
				$login = $this->_model->login($_POST['username'], $_POST['password'], $this->_db);
				
				if ($login)
				{
					Base_Application::redirect("/play");
				}
			}
		}
	}

?>
