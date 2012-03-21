<?php

	class Dao_Mysql extends Abstract_Database_Database
	{
		private $driver;
		private $connection;
		private $config;
		
		public function __construct()
		{
			
		}
		
		public function setconfig(Array $config)
		{
			$this->config = $config;
		}
		
		public function connect()
		{
			try {
				$this->connection = mysql_connect(
					$this->config['host'],
					$this->config['username'],
					$this->config['password']
				);
				
				if (!$this->connection)
				{
					Throw new Exception("Db error", 2);
				} else {
					mysql_select_db($this->config['dbname']);
				}
			} catch (Exception $e)
			{
				Throw new ErrorException($e->getMessage(), $e->getCode());
			}
		}
		
		public function disconnect() 
		{
			
		}
		
		public function delete(String $table, $id) {

		}

		public function query( $query) {
			try 
			{
				$result = mysql_query($query, $this->connection) or die(mysql_error());
				return $result;
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		
		public function getInsertId()
		{
			return mysql_insert_id();
		}

		public function update(String $table, $data, $id) {

		}

		public function escape($value)
		{
			return mysql_real_escape_string($value);
		}

		public function fetchRow($result)
		{
			$row = mysql_fetch_assoc($result);
			if(!$row)
			{
				return false;
			}
			
			return $row;
		}
	}