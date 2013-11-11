<?
class Comment extends AppModel{
	
	var $name = 'Comment';
	
	var $belongsTo = array(
		'On' => array(
			'className' => 'Whisper',
			'foreignKey' => 'whisper_id',
			'type' => 'INNER'
		),
		'By' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'type' => 'INNER'
		)
	);
	
	var $hasMany = array(
		'ToNotify' => array(
			'className' => 'Response'
		)
	);
		
}
?>