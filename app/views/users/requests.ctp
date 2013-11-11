<table id='main' border='0' cellspacing='4'>
	<tr>
		<td align='center' valign='top' class='left_right_td_border'>
			<?php e($this->element('left', array('action'=>'frequests'))); ?>
		</td>
		<td valign='top' align='center' class='center_td_border'>
			<div class='main_content_title_container'>
				<?php if(!$sent){ ?>
					Received Friend Requests
					&nbsp;&nbsp;&nbsp;
					<?php e($this->Html->link('View Sent Requests', array('controller'=>'users', 'action'=>'requests', 'sent'))); ?>
				<? } else{ ?>
					<?php e($this->Html->link('Received Friend Requests', array('controller'=>'users', 'action'=>'requests'))); ?>
					&nbsp;&nbsp;&nbsp;
					View Sent Requests
				<? } ?>
			</div>
			<?php if(count($frequests)<1){ ?>
				<div class='new_whisper_box'>
					<?php if($sent){ ?>
						<div class='general_title' style='text-align:left' align='center'>You didn't send any friend request.</div>
					<?php } else{ ?>
						<div class='general_title' style='text-align:left' align='center'>You have no friend request.</div>
					<?php } ?>
				</div>
			<? } ?>		
			<?php for($i=0; $i<count($frequests); $i++){ ?>
				<div class='read_item_in_whisper_list'>
					<table width='100%' border='0' cellspacing='0'>
						<tr>
							<td width='70%'>
								<?php if($sent){ ?>
									<?php e('You have sent friend request to '.$this->Html->link($frequests[$i]['User']['firstname'].' '.$frequests[$i]['User']['secondname'], array('controller'=>'users', 'action'=>'profile', $frequests[$i]['User']['id']))); ?>.
								<?php } else{ ?>
									<?php e($this->Html->link($frequests[$i]['User']['firstname'].' '.$frequests[$i]['User']['secondname'], array('controller'=>'users', 'action'=>'profile', $frequests[$i]['User']['id']))); ?> requested to be your friend.
								<?php } ?>
							</td>
							<td align='right'>
								<?php if(!$sent){ ?>
									<?php e($this->Html->link('Accept this request', array('controller'=>'users', 'action'=>'accept_friendship', $frequests[$i]['User']['id']))); ?>
								<?php } ?>
							</td>
						</tr>
					</table>
				</div>
			<?php } ?>
		</td>
	</tr>			
</table>