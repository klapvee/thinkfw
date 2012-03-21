<?php


	/**
	 * Description of QuestionOpen
	 *
	 * @author willem
	 */
	class Question_Open extends Question_Abstract_Base
	{
		public function getQuestion() 
		{
			return $this->getData('question');
		}
		
		
	}

?>
