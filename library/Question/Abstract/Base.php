<?php


	/**
	 * Description of Base
	 *
	 * @author willem
	 */
	abstract class Question_Abstract_Base 
	{
		private $_type;
		private $_data;
		private $_answers;
		private $_db;
		private $_correct;
		private $_points;
		private $_myAnswer;
		
		abstract function getQuestion();
		
		public function setType($type)
		{
			$this->_type = $type;
		}
		
		public function getCorrect()
		{
			return $this->_correct;
		}
		
		public function getAnswers()
		{
			return $this->_answers;
		}
		
		public function compareAnswer($answer) 
		{
			$this->_myAnswer = $answer;
			$arr = Array();
			$points = 0;
			
			$answer = trim(strtolower($answer));
			$correct = false;
			foreach ($this->_answers as $index => &$obj)
			{
				if (strtolower($obj->getAnswer()) == $answer)
				{
					if ($obj->isValid())
					{
						$points = $obj->getPoints();
						$correct = true;
					}
				}
			}
			
			$this->_points = $points;
			$this->_correct = $correct;
			
			$arr['points'] = $points;
			$arr['correct'] = $correct;
			
			return $arr;
		}
		
		public function getData($index)
		{
			return $this->_data[$index];
		}
		
		public function setData($data)
		{
			$this->_data = $data;
			$this->loadAnswers();
		}
		
		public function loadAnswers()
		{
			$db = Base_Application::getDatabase();
			
			$answers = Array();
			$result = $db->query("
				SELECT * FROM answers WHERE id_question = '". (int) $this->_data['id'] ."'
			");
			
			while ($row =  $db->fetchRow($result))
			{
				$answer = new Question_Answer();
				$answer->setPoints(25);
				$answer->setAnswer($row['answer']);
				$answer->setValid($row['valid']);
				$this->addAnswer($answer);
			}
		}
		
		public function addAnswer(Question_Answer $answer)
		{
			$this->_answers[] = $answer;
		}
		
		public function getMyAnswer()
		{
			return $this->_myAnswer;
		}
		
		public function getAnswersString()
		{
			$answers = Array();
			foreach ($this->_answers as $index => &$obj)
			{
				$answers[] = $obj->getAnswer();
			}
			
			return $answers;
		}
	}

?>
