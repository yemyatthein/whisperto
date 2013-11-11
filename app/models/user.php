<?
class User extends AppModel{
	
	var $name = 'User';
	
	var $hasMany =  array(
        'Whisper' => array(
			'className' => 'Whisper',
		),
		'Comment' => array(
			'className' => 'Comment',
		),
		'CanSee' => array(
			'className' => 'Visible'
		),
		'BeNotified' => array(
			'className' => 'Response'
		)
    );
		
	var $hasAndBelongsToMany = array(
		'Friend' => array(
			'className' => 'User',
			'joinTable' => 'users_users',
			'foreignKey' => 'user_id_1',
			'associationForeignKey' => 'user_id_2'
		)
	);
	
}
?>