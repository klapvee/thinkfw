<?php

	class Base_Application
	{
		public static $database;
		public static $rand = 'thfw@sadg80!!';

		public static function setDatabase(Abstract_Database_Database $daoObject)
		{
			self::$database = $daoObject;
		}

		public static function getDatabase()
		{
			return self::$database;
		}

		public static function salt($string1, $string2)
		{
			return md5($string1 . $string2 . self::$rand);
		}
		
		public static function redirect($location)
		{
			try {
				header("Location: " . $location);
				exit;
			} catch (Exception $e) {
				
			}
		}
	}