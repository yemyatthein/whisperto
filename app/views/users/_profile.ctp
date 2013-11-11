<?php if($user_of_interest != null) { ?>
	You are visiting as <? echo $userdata['username']; ?>.
	<br/><br/>
	This user's information: 
	<?php	
	if($userdata['userid'] == $user_of_interest['User']['id']){
		e('<b> (This is you)</b>');
	}
	?>
	<br/>
	UserID: <? e($user_of_interest['User']['id']); ?><br/>
	Username: <? e($user_of_interest['User']['username']); ?><br/>
	Name: <? e($user_of_interest['User']['name']); ?><br/>
	
	<?php 
	if(!$already_friend_or_not_myself){
		e($html->link('Add as Friend', array('controller' => 'users', 'action' => 'add_friend', $user_of_interest['User']['id'])).'<br/>'); 
	}
	?>
	<br/>
	<?php e($html->image($user_of_interest['User']['profile_image'], array('width' => '200px'))); ?>
<?php } ?>