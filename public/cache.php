<?php

    $exp = explode("/",  $_SERVER['REQUEST_URI']);

    if ($exp[1] === 'css') {
            header("Content-Type: text/css");
    }

    $path = realpath($_SERVER['DOCUMENT_ROOT'] . '../') . '/application/cache';
    $uri = str_replace('/gather', '', $_SERVER['REQUEST_URI']);

    echo file_get_contents($path.$uri);
	
?>