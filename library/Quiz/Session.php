<?php


	/**
	 * Description of Session
	 *
	 * @author willem
	 */

	class Quiz_Session 
	{
		private $_questions;
		private $_config;
		private $_id;
		private $_db;
		private $_index;
		private $_totalPoints;
		
		public function __construct()
		{
			$this->_config = $_POST;
		}
		
		public function init()
		{
			$this->_db = Base_Application::getDatabase();
			$this->_index = 0;
			
			$this->startSession();
			$this->setQuestions();					
		}
		
		public function answered($answer)
		{
			$this->_totalPoints += $answer['points'];
			$this->_index = $this->_index + 1;
		}
		
		public function startSession()
		{
			$catQuery = '';
			
			if ($this->_config['category'] > 0 )
			{
				$catQuery = "AND id_category = '" . (int) $this->_config['category'] . "'";
			}
			
			$this->_db->query("
				INSERT INTO sessions
				SET
					session = '" .  md5(time()) . "',
					id_category = '" .  (int) $this->_config['category'] . "',
					level = '" .  (int) $this->_config['level'] . "',
					date = '" . date("Y-m-d H:i:s", time()) . "',
					number_of_questions = '" .  (int) $this->_config['num_questions'] . "',
					id_user = '". (int) $_SESSION['user']['id']."'
			");

			$this->_id = $this->_db->getInsertId();
		}
		
		public function setQuestions()
		{
			$catQuery = '';
			
			if ($this->_config['category'] > 0 )
			{
				$catQuery = "AND id_category = '" . (int) $this->_config['category'] . "'";
			}
			
			$result = $this->_db->query("
				SELECT 
					questions.*,
					category.label AS category 
				FROM questions 

				LEFT JOIN
					category ON questions.id_category = category.id
				WHERE level = '" . (int) $this->_config['level'] . "'
				".$catQuery."
				ORDER BY RAND()
				LIMIT 0, " . (int) $this->_config['num_questions'] . "

			") or die (mysql_error());

			$arr = Array();
			while ($row = $this->_db->fetchRow($result))
			{
				if ($row['id_type'] == 1)
				{
					$question = new Question_Open();
				} else {
					$question = new Question_Mp();
				}
				
				$question->setData($row);
				$this->_questions[] = $question;
				
			}
		}
		
		public function getNumberOfQuestions()
		{
			return count($this->_questions);
		}
		
		public function getCurrentIndex()
		{
			return $this->_index;
		}
		
		public function getQuestion($index)
		{
			if ($index < 0) $index = 0;
			return $this->_questions[$index];
		}
		
		public function getCurrentQuestion()
		{
			return $this->_questions[$this->_index];
		}
		
		public function getPoints()
		{
			return $this->_totalPoints;
		}
	}

?>
