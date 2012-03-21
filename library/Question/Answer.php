<?php



	/**
	 * Description of QuestionAnswer
	 *
	 * @author willem
	 */
	class Question_Answer 
	{
		private $_points;
		private $_answer;
		private $_valid;
		
		public function __construct()
		{
			
		}
		
		public function getAnswer()
		{
			return $this->_answer;
		}
		
		public function setAnswer($answer)
		{
			$this->_answer = $answer;
		}
		
		public function setPoints($points)
		{
			$this->_points = $points;
		}
		
		public function getPoints()
		{
			return $this->_points;
		}
		
		public function setValid($valid)
		{
			$this->_valid = $valid;
		}
		
		public function isValid()
		{
			return $this->_points;
		}
	}

?>
