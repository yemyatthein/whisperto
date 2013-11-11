<?php e($html->script("js_view_whisper")); ?>
<table id='main' border='0' cellspacing='4'>
	<tr>
		<td align='center' valign='top' class='left_right_td_border'>
			<?php e($this->element('left', array('action'=>''))); ?>
		</td>
		<td align='center' valign='top' class='center_td_border'>
			<div class='new_whisper_box'>
				<table width='100%' border='0'>
					<tr>
						<td>
							<table>
								<tr>
									<td>
										<?php e($this->Html->image('users/'.$whisper[0]['u']['profile_image'], array('width'=>40, 'height'=>40))); ?>
									</td>
									<td style='padding-left:5px'>
										<?php e($this->Html->link($whisper[0]['u']['firstname'].' '.$whisper[0]['u']['secondname'].':', array('controller'=>'users', 'action'=>'profile', $whisper[0]['u']['id']))); ?>
									</td>
								</tr>
							</table>
							
						</td>
					</tr>
				</table>
				<div class='whisper_contents_display'>
					<?php echo nl2br($whisper[0]['w']['content']); ?>
				</div>
				<div class='general_title'>To:</div>
				<div class='whisper_target_display'>
					<?php for($i=0; $i<count($to); $i++){ ?>
						<?php e($this->Html->link($to[$i]['u']['firstname'].' '.$to[$i]['u']['secondname'], array('controller'=>'users', 'action'=>'profile', $to[$i]['u']['id']))); ?>
						<?php 
							if($i<(count($to)-1)){
								e('&nbsp;&nbsp;&nbsp;');
							}
						?>
					<?php } ?>
				</div>
				<div class='whisper_below_button_container'>
					<table width='100%' border='0' cellspacing='0'>
						<tr>
							<td align='left' width='60%'>
								<span class='time_display'><?php echo $time->nice($whisper[0]['w']['time_created']) ?></span>
							</td>
							<td align='right'>
								<?php if($ignore[0]['uw']['interested']=='0'){ ?>
									<a class='mini' id='ignore_whisper' href='#'>Don't Ignore</a>&nbsp;&nbsp;&nbsp;
								<?php }else{ ?>
									<a class='mini' id='ignore_whisper' href='#'>Ignore</a>&nbsp;&nbsp;&nbsp;
								<?php } ?>
								<a class='mini' id='show_response' href='#'>Response</a>
							</td>
						</tr>
					</table>
				</div>
				<div class='comment_container'>
					<?php for($i=0; $i<count($comments); $i++){ ?>
						<div class='comment_item_container'>
							<table border='0' cellspacing='0'>
								<tr>
									<td valign='top'>
										<?php e($this->Html->image('users/'.$comments[$i]['u']['profile_image'], array('width'=>40, 'height'=>40))); ?>
									</td>
									<td valign='top' style='padding-left: 5px;'>
										<?php e($this->Html->link($comments[$i]['u']['firstname'].' '.$comments[$i]['u']['secondname'], array('controller'=>'users', 'action'=>'profile', $comments[$i]['u']['id']))); ?>: <?php echo nl2br($comments[$i]['c']['content']); ?>
										<div class='comment_time_display'>
											<span class='time_display'><?php echo $time->nice($comments[$i]['c']['time_created']); ?></span>
										</div>
									</td>									
								</tr>
							</table>
						</div>
					<? } ?>
					<div id='additional_comment_container'>
					</div>
					<div class='input_comment_item_container'>
						<textarea id='comment_data' class='comment_content_input'></textarea>
						<input type='hidden' id='whisper_id' value='<?php echo $whisper[0]['w']['id']; ?>' />
					</div>

				</div>
			</div>
		</td>
	</tr>			
</table>