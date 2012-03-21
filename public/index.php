<?php

	ini_set('display_errors', 'on');
	error_reporting(E_ALL);
	
	define('APPLICATION_PATH', realpath($_SERVER['DOCUMENT_ROOT'] . '/../application'));
	define('BASE_PATH', realpath($_SERVER['DOCUMENT_ROOT'] . '/../'));
	
	set_include_path(get_include_path() . PATH_SEPARATOR . APPLICATION_PATH);
	set_include_path(get_include_path() . PATH_SEPARATOR . APPLICATION_PATH . '/Controllers');
	set_include_path(get_include_path() . PATH_SEPARATOR . APPLICATION_PATH . '/Models');
	set_include_path(get_include_path() . PATH_SEPARATOR . BASE_PATH . '/library');
	
	require BASE_PATH . '/library/autoloader.php';
	require APPLICATION_PATH . '/Bootstrap.php';
	
	spl_autoload_register(array('AutoLoader', 'autoload'));

	$bootstrap = new Bootstrap();
	$bootstrap->boot();
	
	$path = explode('/', $_SERVER['REQUEST_URI']);
	$class = empty($path[1]) ? 'index' : $path[1];
	$class = ucfirst($class) . 'Controller';

	$obj = new $class;
	$obj->getView()->setFrontController($obj);
	
	if (method_exists($obj, 'init'))
	{
		$obj->setPath($path);
		$obj->init();
	}

	$action = !isset($path[2]) ? 'index' : $path[2];
	$action .= 'Action';

	if (method_exists($obj, $action))
	{
		$obj->$action();
	} else {
		echo "not found " . $action;
	}

	$obj->view->show();