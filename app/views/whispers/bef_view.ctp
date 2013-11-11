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
						<td width='65%'>
							<a href=''><?php echo $whisper[0]['u']['firstname'].' '.$whisper[0]['u']['secondname']; ?>:</a>
						</td>
					</tr>
				</table>
				<div class='whisper_contents_display'>
					<?php echo $whisper[0]['w']['content']; ?>
				</div>
				<div class='general_title'>To:</div>
				<div class='whisper_target_display'>
					<?php for($i=0; $i<count($to); $i++){ ?>
						<?php echo '<a href="">'.$to[$i]['u']['firstname'].' '.$to[$i]['u']['secondname'].'</a>&nbsp;&nbsp;&nbsp;'; ?>
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
							<a href=''><?php echo $comments[$i]['u']['firstname'].' '.$comments[$i]['u']['secondname'] ?>: </a>&nbsp;<?php echo $comments[$i]['c']['content']; ?>
							<div class='comment_time_display'>
								<span class='time_display'><?php echo $time->nice($comments[$i]['c']['time_created']); ?></span>
							</div>
						</div>
					<? } ?>
					<div id='additional_comment_container'>
					</div>
					<div class='input_comment_item_container'>
						<textarea id='comment_data' class='comment_content_input'></textarea>
						<input type='hidden' id='whisper_id' value='<?php echo $whisper[0]['w']['id']; ?>' />
						<div class='comment_submit_container'>
							<input type='submit' id='comment_submit' value='Response' />
						</div>
					</div>

				</div>
			</div>
		</td>
		<td align='center' valign='top' class='left_right_td_border'>
			<?php e($this->element('right')); ?>
		</td>				
	</tr>			
</table>