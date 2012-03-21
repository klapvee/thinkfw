<?php

	/**
	 * Description of LogoutController
	 *
	 * @author willem
	 */

	class LogoutController extends Base_Controller_Action
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
			session_destroy();
			Base_Application::redirect('/');
		}
	}

?>
