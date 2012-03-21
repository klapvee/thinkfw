<?php

	class Model_Index
	{
		public function getSession()
		{
			
		}
		
		public function getCategories($db)
		{
			
			$categories = Array();
			$result = $db->query("SELECT * FROM category WHERE parent = 0");
			
			while($row = $db->fetchRow($result))
			{
				$categories[$row['label']] = Array();
				$resultSub = $db->query("SELECT * FROM category WHERE parent = '". (int) $row['id'] ."'");
				
				
				while($rowSub = $db->fetchRow($resultSub))
				{
					$categories[$row['label']][] = $rowSub;
				}
			}
			
			return $categories;
		}
	}