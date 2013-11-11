<?php
class CommonComponent extends Object{

	var $name = 'Common';
	var $components = array('Auth', 'Email');
	
	function singleColumnQueryResultIntoArray($data){
		$collection = array();
		foreach($data as $element){
			array_push($collection, array_pop(array_pop($element)));
		}
		return $collection;
	}	
	
	function updateCounts(){
		App::import('Model','User');
		$current_user = $this->Auth->user();
		$user = new User();
		$result1 = $user->CanSee->find('all', array(
				'conditions' => array(
					'CanSee.user_id' => $current_user['User']['id'],
					'CanSee.seen' => '0'
				)
			)
		);
		$count_new_in = count($result1);
		
		$result2 = $user->BeNotified->find('all', array(
				'conditions' => array(
					'BeNotified.user_id' => $current_user['User']['id']
				)
			)
		);
		$count_new_resp = count($result2);		
				
		$result = array('inboxcount' => $count_new_in,'responsecount' => $count_new_resp);
		return $result;
	}
	
	function imageUpload($path, $filename, $ext, $data){
		$photo_ok = false;
		if(!empty($data) && ($data['error'] == 0)) {
			if (((($ext == "jpg") && ($data["type"] == "image/jpeg")) || (($ext == "jpg") && ($data["type"] == "image/pjpeg")) || (($ext == "JPG") && ($data["type"] == "image/jpeg")) || (($ext == "JPG") && ($data["type"] == "image/pjpeg")) || (($ext == "gif") && ($data["type"] == "image/gif")) || (($ext == "png") && ($data["type"] == "image/png"))) && ($data["size"] < 5000000)) {
				$newname = $path.'/'.$filename;
				if ((move_uploaded_file($data['tmp_name'],$newname))) {
					$photo_ok = true;
				} else {
					// Upload Error Message
				}
			}
		}					
		return $photo_ok;
	}
	
	function deleteDir($dirPath) {
		if (! is_dir($dirPath)) {
			e('<p>'.$dirPath.' is not a directory.</p>');
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				self::deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}
	
	function emailing($to_address, $subject, $content){
		$this->Email->smtpOptions = array(
			'port' => '465',
			'timeout' => '30',
			'host' => 'ssl://smtp.gmail.com',
			'username' => 'hbproject.tests@gmail.com',
			'password' => 'extraordinary',
		);
		$this->Email->delivery = 'smtp';
		$this->Email->sendAs = 'html';
		$this->Email->from = 'whpt <hbproject.tests@gmail.com>';
		$this->Email->to = $to_address;
		$this->Email->subject = $subject;
		$this->Email->send($content);
		//var_dump($this->Email->smtpError);
	}
	
}
?>