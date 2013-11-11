<div class='right_menu_profile_summary_box'>	
	<?php echo $html->link($html->image($userdata['profile_image'], array('width'=>'100', 'height'=>'100')), '/users/profile/'.$userdata['userid'], array('escape'=>false)); ?>
	<div class='profile_name'>
		<?php echo $html->link($userdata['firstname'].' '.$userdata['secondname'],  '/users/profile/'.$userdata['userid']); ?>
	</div>
</div>
<div style='margin-top:20px;'>						
	<div class='left_right_menu_item_container'><?php echo $html->link('View My Profile',  '/users/profile/'.$userdata['userid']); ?></div>
	<div class='left_right_menu_item_container'><?php echo $html->link('View My Friends',  '/users/friends'); ?></div>
</div>