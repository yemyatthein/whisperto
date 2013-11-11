<?php e($html->script("js_new_whisper")); ?>
<table id='main' border='0' cellspacing='4'>
	<tr>
		<td align='center' valign='top' class='left_right_td_border'>
			<?php e($this->element('left', array('action'=>'new_whisper'))); ?>
		</td>
		<td align='center' valign='top' class='center_td_border'>
			<?php e($form->create('Whisper', array('action'=>'add_new_whisper', 'id'=>'new_whisper_form',  'onsubmit'=>'add_data_submit()')));?>
				<div class='new_whisper_box'>
					<div class='general_title'>Whisper message:</div><a href='#friends'id='show_friends' rel='facebox'>hidden</a>
					<div>
						<textarea name='content' id='whisper_content' class='whisper_content_input'></textarea>
					</div>
					<div class='general_title'>Recipients (Maximum 5 people) : </div>

					<div class='box_containing_recipient_related' id='search_friends_container'>
						<div>
							<table border='0' cellspacing='0'>
								<tr>
									<td>
										<span class='mini_instructions'>Type the name of your friends to search: </span>
										<input id='friends_name' type='text' value='' />
									</td>
									<td>
										&nbsp;&nbsp;
										<?php echo $html->link($html->image('button_search.png', array('width'=>'26', 'height'=>'22', 'title'=>'Search Friends')), '#', array('id'=>'search_friends', 'escape'=>false)); ?> &nbsp;&nbsp; <?php echo $html->link($html->image('button_browse.png', array('width'=>'26', 'height'=>'22', 'title'=>'Browse Friends')), '#', array('id'=>'browse_friends', 'escape'=>false)); ?>
									</td>
								</tr>
							</table>
						</div>
						
						<div id='friends' class='facebox_container'></div>
						
					</div>
					
					
					<div class='box_containing_recipient_related' id='recipient_area'>						
						<?php if($selected != null){ ?>
							<script>
								add_temporary('<?php echo $selected[0]['u']['id']; ?>', '<?php echo $selected[0]['u']['firstname']; ?>', '<?php echo $selected[0]['u']['secondname']; ?>');
							</script>
						<? }else{ ?>
							<span class='mini_instructions' id='zero_recipient_message'>&nbsp;No recipient is added yet.</span>
						<? } ?>
					</div>
					<div class='whisper_submit_container'>
						<?php echo $html->link($html->image('button_submit_whisper.png', array('width'=>'90', 'height'=>'30')), '#', array('id'=>'whisper_submit', 'escape'=>false)); ?>
					</div>
				</div>
			<?php e($form->end()); ?>

		</td>				
	</tr>			
</table>