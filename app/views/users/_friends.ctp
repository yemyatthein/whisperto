<?php if($results != NULL){ ?>
	<?php foreach($results as $elem){ ?>
		<table>
			<tr>
				<td>
					<?php e($html->link($html->image('users/'.$elem['User']['profile_image'], array('width' => '200px')), 'profile/'.$elem['User']['id'], array('escape' => false))); ?>
				</td>
				<td>
					Username: <?php e($elem['User']['username']); ?><br/>
					Name: <?php e($elem['User']['firstname']); ?><br/>
				</td>
			</tr>
		</table>
	<? } ?>
<? } ?>