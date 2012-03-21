<?php

	class Base_View
	{	
		private $layout;
		private $view;
		private $render;
		public $content;
		public $path;
		public $frontController;
		
		
		public function __construct()
		{
			$this->render = true;
			$this->layout = 'layout.phtml';
		}
		
		public function getView()
		{
			
		}

		public function setFrontController($controller)
		{
			$this->frontController = $controller;
		}

		public function getFrontController()
		{
			return $this->frontController;
		}
		
		public function getLayout()
		{
			if (!$this->render) return;
			require APPLICATION_PATH . '/layouts/' . $this->layout;
		}
		
		public function content()
		{
			if (!$this->render) return;
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
			$this->render = $render;
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