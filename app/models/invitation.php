<?
class Invitation extends AppModel{
	
	var $name = 'Invitation';
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);
	
}
?>