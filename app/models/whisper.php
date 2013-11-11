<?
class Whisper extends AppModel{
	
	var $name = 'Whisper';
	
	var $belongsTo = array(
		'CreatedBy' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'type' => 'INNER'
		)
	);
	
	var $hasMany =  array(
        'Comment' => array(
			'className' => 'Comment'
		),
		'VisibleTo' => array(
			'className' => 'Visible'
		)
    );
	
	
}
?>