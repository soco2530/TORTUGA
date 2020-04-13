<?php
	class Cleaner 
	{
		public function clean($mysqli, $input)
		{
			$input = $mysqli->real_escape_string($mysqli, $input);		
			return $input;
		}
	}	
?>