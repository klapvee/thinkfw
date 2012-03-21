<?php

	class Model_Login
	{
		public function login($username, $pwd, $db)
		{
			$pwd = Base_Application::salt($username, $pwd);
			
			$result = $db->query("
				SELECT * FROM users
				WHERE username = '" . $db->escape($username) . "'
				AND password = '" . $db->escape($pwd) . "'
			");
			
			$row = $db->fetchRow($result);
			
			if (isset($row['id']))
			{
				$_SESSION['user'] = $row;
				return true;
			} else {
				return false;
			}
			
		}
	}