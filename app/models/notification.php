<?
class Notification extends AppModel{
	
	var $name = 'Notification';
	
	var $belongsTo = array(
		'UserTo' => array(
			'className' => 'User',
			'foreignKey' => 'user_to'
		),
		'UserFrom' => array(
			'className' => 'User',
			'foreignKey' => 'user_from'
		)
	);
	
}
?>