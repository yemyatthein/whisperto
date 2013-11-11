<table id='main' border='0' cellspacing='4'>
	<tr>
		<td align='center' valign='top' class='left_right_td_border'>
			<?php e($this->element('left', array('action'=>'notifications'))); ?>
		</td>
		<td valign='top' align='center' class='center_td_border'>
			<?php if(count($ntf)<1){ ?>
				<div class='new_whisper_box'>
					<div class='general_title' align='center'>You don't have any notification yet.</div>
				</div>
			<? } ?>		
			<?php for($i=0; $i<count($ntf); $i++){ ?>
				<?php if($ntf[$i]['Notification']['seen'] == '0'){ ?>
					<div class='unread_item_in_whisper_list'>
				<?php }else{ ?>
					<div class='read_item_in_whisper_list'>
				<?php } ?>
					<?php if($ntf[$i]['Notification']['type'] == '0'){ ?>
						<table width='100%' border='0'>
							<tr>
								<td width='75%'>
									<a href="#">Ye Myat</a> sent you a friendship request. You can see in <a href="#">Friend Requests</a>
								</td>
								<td align='right'>
									<span class='time_display'><?php e($time->nice($ntf[$i]['Notification']['time_created'])); ?></span>
								</td>
							</tr>
						</table>
					<?php } else if($ntf[$i]['Notification']['type'] == '1'){ ?>
						<table width='100%' border='0'>
							<tr>
								<td width='75%'>
									<a href="#">Ye Myat</a> accepted your friendship request. 
								</td>
								<td align='right'>
									<span class='time_display'><?php e($time->nice($ntf[$i]['Notification']['time_created'])); ?></span>
								</td>
							</tr>
						</table>
					<?php } ?>
				</div>
			<?php } ?>
			
		</td>
	</tr>			
</table>