<?
class Response extends AppModel{
	
	var $name = 'Response';
	var $primaryKey = 'for_cake';
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'comment_id'
		)
	);
	
}
?>