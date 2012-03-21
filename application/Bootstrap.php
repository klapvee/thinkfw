<?php


	class Bootstrap
	{		
		private $config;
		private $errorHandler;
		private $connection;
		
		public  function __construct()
		{
			$this->errorHandler = new Handler_ErrorHandler();
			$this->config = parse_ini_file(APPLICATION_PATH . "/configs/siteconfig.ini", true);
		}
		
		public function boot()
		{
			// start session
			@session_start();
			
			// init db connection
			try {
				$dao = "Dao_" . ucfirst($this->config['DATABASE']['driver']);
				$this->connection = new $dao;
				$this->connection->setConfig(($this->config['DATABASE']));
				$this->connection->connect();

				Base_Application::setDatabase($this->connection);
				
			} catch (Exception $e)
			{
				
			}
		}
	}