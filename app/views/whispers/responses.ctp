<table id='main' border='0' cellspacing='4'>
	<tr>
		<td align='center' valign='top' class='left_right_td_border'>
			<?php e($this->element('left', array('action'=>'responses'))); ?>
		</td>
		<td align='center' valign='top' class='center_td_border'>
			<?php if(count($responses)<1){ ?>
				<div class='new_whisper_box'>
					<div class='general_title' align='center'>Opps! There is no response yet.</div>
				</div>
			<? } ?>			
			<?php for($i=0; $i<count($responses); $i++){ ?>
				<?php if($this->Utility->checkContains($new, $responses[$i]['Comment']['id'])){ ?>
					<div class='unread_item_in_whisper_list'>
				<?php }else{ ?>
					<div class='read_item_in_whisper_list'>
				<?php } ?>
					<table width='100%' border='0' cellspacing='0'>
						<tr>
							<td width='70%'>
								<?php
								$disp = "your";
								if($whisper_creators[$responses[$i]['Comment']['id']][0]['u']['id'] != $userdata['userid']){
									$disp = "the";
								}
								?>
								<a href=''><?php echo $html->link($commenters[$responses[$i]['Comment']['id']][0]['u']['firstname'].' '.$commenters[$responses[$i]['Comment']['id']][0]['u']['secondname'],'/users/profile/'.$commenters[$responses[$i]['Comment']['id']][0]['u']['id']); ?></a><span class="mini_instructions"> responded <?php e('<b>"'.$this->Presentation->shortenString($responses[$i]['Comment']['content'], 30).'...'.'"</b>');  ?> to <?php echo $disp; ?> whisper </span> <a href=''><?php echo $html->link($this->Presentation->shortenString($responses[$i]['On']['content'], 30).'...', '/whispers/view/'.$responses[$i]['On']['id']); ?></a>
							</td>
							<td align='right'>
								<span class='time_display'><?php echo $time->nice($responses[$i]['Comment']['time_created']); ?></span>
							</td>
						</tr>
					</table>
				</div>			
			<? } ?>
			<div class='pagination_container'>
				<?php if($this->Paginator->hasNext() || $this->Paginator->hasPrev()){ ?>
					<?php e($paginator->prev()); ?> &nbsp; <?php e($paginator->numbers()); ?> &nbsp; <?php e($paginator->next()); ?>
				<?php } ?>
			</div>
		</td>				
	</tr>			
</table>