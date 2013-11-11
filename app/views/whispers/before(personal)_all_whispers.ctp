<table id='main' border='0' cellspacing='4'>
	<tr>
		<td align='center' valign='top' class='left_right_td_border'>
			<?php e($this->element('left', array('action'=>'all_whisper'))); ?>
		</td>
		<td align='center' valign='top' class='center_td_border'>
			<?php if(count($whispers)<1){ ?>
				<div class='new_whisper_box'>
					<div class='general_title' align='center'>Opps! Nobody has ever whispered to you and you also have never whispered to anyone yet.</div>
				</div>
			<? } ?>
			<?php for($i=0; $i<count($whispers); $i++){ ?>
				<?php if($whispers[$i]['uw']['seen']==0){ ?> <div class='unread_item_in_whisper_list'> 
				<? }else{ ?> <div class='read_item_in_whisper_list'> <? } ?>
					<table width='100%' border='0'>
						<tr>
							<td width='70%'>
								<?php
								$display_creator = '<span class="mini_instructions">You whispered to some of your friends</span>';
								if($creators[$whispers[$i]['w']['id']][0]['users']['id'] != $userdata['userid']){
									$display_creator = $html->link($creators[$whispers[$i]["w"]["id"]][0]["users"]["firstname"].' '.$creators[$whispers[$i]["w"]["id"]][0]["users"]["secondname"], '/users/profile/'.$creators[$whispers[$i]["w"]["id"]][0]["users"]["id"]).' <span class="mini_instructions">whispered to you</span>';
								}
								?>
								<?php echo $display_creator; ?> : <?php echo '<span class="whisper_summary">'.$html->link($whispers[$i]['w']['content'].' ...', '/whispers/view/'.$whispers[$i]['w']['id']).'</span>'; ?>
								
							</td>
							<td align='right'>
								<span class='time_display'><?php e($time->nice($whispers[$i]['w']['time_created'])); ?></span>
							</td>
						</tr>
					</table>
					<div class='whisper_meta_info_container'>
						<?php echo $html->link($comments[$whispers[$i]['w']['id']][0][0]['comment_count'].' responses', '/whispers/view/'.$whispers[$i]['w']['id'], array('class'=>'mini')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo $html->link('View this whisper', '/whispers/view/'.$whispers[$i]['w']['id'], array('class'=>'mini')); ?>
					</div>
				</div>
			<?php } ?>
			
		</td>
		<td align='center' valign='top' class='left_right_td_border'>
			<?php e($this->element('right')); ?>
		</td>				
	</tr>			
</table>