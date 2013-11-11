<?php
class PresentationHelper extends AppHelper {
	
	var $name = 'Presentation';
		
	function shortenString($data, $length){
		return substr($data, 0, $length);
	}
	
}

?>