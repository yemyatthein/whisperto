<div class="new_whisper_button">
	<?php echo $html->link($html->image('button_new_whisper.png', array('width'=>'150', 'height'=>'35')), '/whispers/new_whisper', array('escape'=>false)); ?>
</div>
<div style='margin-top:5px;'>
	<?php
	$inbox = "";
	if($inboxcount>0){
		$inbox = " (".$inboxcount.")";
	}
	$resp = "";
	if($responsecount>0){
		$resp = " (".$responsecount.")";
	}
	$notf = "";
	if($notificationcount>0){
		$notf = " (".$notificationcount.")";
	}
	?>
	<div class='left_menu_subcontainer'>
	<?php if($action == 'inbox'){ ?>		
		<div class='selected_left_right_menu_item_container'>
			<?php echo $html->link('Incoming'.$inbox, '/whispers/list_whispers/incoming'); ?>
		</div>
	<?php } else{ ?>
		<div class='left_right_menu_item_container'>
			<?php echo $html->link('Incoming'.$inbox, '/whispers/list_whispers/incoming'); ?>
		</div>
	<?php } ?>
	<?php if($action == 'outbox'){ ?>
		<div class='selected_left_right_menu_item_container'>
			<?php echo $html->link('Outgoing', '/whispers/list_whispers/outgoing'); ?>
		</div>
	<?php } else{ ?>
		<div class='left_right_menu_item_container'>
			<?php echo $html->link('Outgoing', '/whispers/list_whispers/outgoing'); ?>
		</div>
	<?php } ?>
	<?php if($action == 'responses'){ ?>
		<div class='selected_left_right_menu_item_container'>
			<?php echo $html->link('Responses'.$resp, '/whispers/responses'); ?>
		</div>
	<?php } else{ ?>
		<div class='left_right_menu_item_container'>
			<?php echo $html->link('Responses'.$resp, '/whispers/responses'); ?>
		</div>
	<?php } ?>
	</div>
	<div class='left_menu_subcontainer'>
		<?php if($action == 'frequests'){ ?>
			<div class='selected_left_right_menu_item_container'>
				<?php echo $html->link('Friend Requests', '/users/requests'); ?>
			</div>
		<?php } else{ ?>
			<div class='left_right_menu_item_container'>
				<?php echo $html->link('Friend Requests', '/users/requests'); ?>
			</div>
		<?php } ?>
		<?php if($action == 'notifications'){ ?>
			<div class='selected_left_right_menu_item_container'>
				<?php echo $html->link('Notifications', '/users/notifications'); ?>
			</div>
		<?php } else{ ?>
			<div class='left_right_menu_item_container'>
				<?php echo $html->link('Notifications'.$notf, '/users/notifications'); ?>
			</div>
		<?php } ?>
		<?php if($action == 'invitation'){ ?>
			<div class='selected_left_right_menu_item_container'>
				<?php echo $html->link('Invite People', '/users/invite_people'); ?>
			</div>
		<?php } else{ ?>
			<div class='left_right_menu_item_container'>
				<?php echo $html->link('Invite People', '/users/invite_people'); ?>
			</div>
		<?php } ?>
	</div>
</div>