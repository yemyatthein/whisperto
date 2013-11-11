<?php
class Visible extends AppModel{
	
	var $name = 'Visible';
	var $useTable = 'users_whispers';	
	var $primaryKey = 'for_cake';
	
	var $belongsTo = array(
		'Whisper' => array(
			'className' => 'Whisper',
			'foreignKey' => 'whisper_id'
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);
}
?>