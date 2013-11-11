<?php
class UtilityHelper extends AppHelper {
	
	var $name = 'Utility';
		
	function checkContains($haystack, $needle){
		for($i=0; $i<count($haystack);$i++){
			if($needle == $haystack[$i]){
				return true;
			}
		}
		return false;
	}
	
}

?>