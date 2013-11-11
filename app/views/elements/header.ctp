<table id='header' style="width:800px" border='0' cellspacing='0'>
	<tr>
		<td>
			<?php echo $html->link($html->image('logo.png'), '#', array('escape'=>false)); ?>
		</td>
		<td align='right'>
			<?php e($this->Html->link('Home', array('controller'=>'whispers', 'action'=>'list_whispers'))); ?>&nbsp;&nbsp;&nbsp;
			<?php e($this->Html->link('Profile', array('controller'=>'users', 'action'=>'profile'))); ?>&nbsp;&nbsp;&nbsp;
			<?php e($this->Html->link('Friends', array('controller'=>'users', 'action'=>'friends'))); ?>&nbsp;&nbsp;&nbsp;
			<?php e($this->Html->link('Find People', array('controller'=>'users', 'action'=>'find_people'))); ?>&nbsp;&nbsp;&nbsp;
			<?php echo $html->link('Logout', '/users/logout', array('escape'=>false)); ?>&nbsp;&nbsp;&nbsp;
		</td>
	</tr>			
</table>