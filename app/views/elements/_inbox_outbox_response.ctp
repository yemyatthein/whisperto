<div class='inside_menu'>
	<table align='center' border='0' cellspacing='0'>
		<tr>
			<td></td>
			<td class='inside_menu_cell_notf'>
				<div class='notification_symbol'>
					<?php
						if($inboxcount>0){
							e($inboxcount);
						}										
					?>
				</div>
			</td>
			<td></td>								
			<td class='inside_menu_cell_notf'>
				<div class='notification_symbol'>
					<?php
						if($responsecount>0){
							e($responsecount);
						}										
					?>
				</div>
			</td>
		</tr>
		<tr>
			<td class='inside_menu_cell'>	
				<a href='#'><?php e($html->image('all.jpg', array('title' => 'All whispers', 'class' => 'inside_menu'))); ?></a>
				<div class='inside_menu_links'>
					<a href='#'>All</a>
				</div>
			</td>								
			<td class='inside_menu_cell'>
				<a href='#'><?php e($html->image('in.jpg', array('title' => 'Friends\' whispers', 'class' => 'inside_menu'))); ?></a>
				<div class='inside_menu_links'>
					<a href='#'>Inbox</a>
				</div>
			</td>
			<td class='inside_menu_cell'>
				<a href='#'><?php e($html->image('out.jpg', array('title' => 'Your whispers', 'class' => 'inside_menu'))); ?></a>
				<div class='inside_menu_links'>
					<a href='#'>Outbox</a>
				</div>
			</td>
			<td class='inside_menu_cell'>
				<a href='#'><?php e($html->image('response.png', array('title' => 'Responses to whispers you are involved', 'class' => 'inside_menu'))); ?></a>
				<div class='inside_menu_links'>
					<a href='#'>Responses</a>
				</div>
			</td>
		</tr>
	</table>
</div>