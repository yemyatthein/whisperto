<?php e($html->script("js_outbox_whisper")); ?>
<table id='main' border='0' cellspacing='4'>
	<tr>
		<td align='center' valign='top' class='left_right_td_border'>
			<?php e($this->element('left', array('action'=>'outbox'))); ?>
		</td>
		<td align='center' valign='top' class='center_td_border'>
			<?php if(count($whispers)<1){ ?>
				<div class='new_whisper_box'>
					<div class='general_title' align='center'>Opps! You have never whispered to anyone yet.</div>
				</div>
			<? } ?>
			<?php for($i=0; $i<count($whispers); $i++){ ?>
				<?php if($whispers[$i]['VisibleTo']['seen']==0){ ?> <div class='unread_item_in_whisper_list'> 
				<? }else{ ?> <div class='read_item_in_whisper_list'> <? } ?>
					<table width='100%' border='0'>
						<tr>
							<td width='70%'>
								<span class="mini_instructions">You whispered to some of your friends:</span> <?php echo '<span class="whisper_summary">'.$html->link($this->Presentation->shortenString($whispers[$i]['Whisper']['content'], 25).' ...', '/whispers/view/'.$whispers[$i]['Whisper']['id']).'</span>'; ?>
							</td>
							<td align='right'>
								<span class='time_display'><?php e($time->nice($whispers[$i]['Whisper']['time_created'])); ?></span>
							</td>
						</tr>
					</table>
					<div class='whisper_meta_info_container'>	
						<?php echo $html->link($comments[$whispers[$i]['Whisper']['id']][0][0]['comment_count'].' responses', '/whispers/view/'.$whispers[$i]['Whisper']['id'], array('class'=>'mini')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo $html->link('View this whisper', '/whispers/view/'.$whispers[$i]['Whisper']['id'], array('class'=>'mini')); ?>
					</div>
				</div>
			<?php } ?>
			<div class='pagination_container'>
				<?php if($this->Paginator->hasNext() || $this->Paginator->hasPrev()){ ?>
					<?php e($paginator->prev()); ?> &nbsp; <?php e($paginator->numbers()); ?> &nbsp; <?php e($paginator->next()); ?>
				<?php } ?>
			</div>
		</td>				
	</tr>			
</table>