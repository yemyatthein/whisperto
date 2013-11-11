<?php e($html->script("js_inbox_whisper")); ?>
<table id='main' border='0' cellspacing='4'>
	<tr>
		<td align='center' valign='top' class='left_right_td_border'>
			<?php e($this->element('left', array('action'=>''))); ?>
		</td>
		<td valign='top' class='center_td_border'>
			<div class='friends_page_box'>
				<div class='friends_container' style='padding-left:15px; padding-top:10px; background-color: #FFF; min-height: 530px;'>
					<table border='0' cellspacing='0'>
						<tr>
						<?php 
						for($i=0; $i<count($friends); $i++){ 
							if($i != 0 && $i%6 == 0){
								echo '</tr><tr>';
							}
						?>
							<td>
								<div class='individual_profile_icon'>
									<?php echo $html->link($html->image('users/'.$friends[$i]['User']['profile_image'], array('width'=>'65', 'height'=>'65')), '/users/profile/'.$friends[$i]['User']['id'], array('escape'=>false)); ?>
									<div class='individual_profile_name'>
										<?php echo $html->link($friends[$i]['User']['firstname'].' '.$friends[$i]['User']['secondname'],'/users/profile/'.$friends[$i]['User']['id']); ?>
									</div>
								</div>
							</td>
						<?
							//if($i == 32){
								//echo '</tr><tr>';
							//}
						} 
						?>
					</table>
				</div>
			</div>
			
			<div class='pagination_container'>
				<?php if($this->Paginator->hasNext() || $this->Paginator->hasPrev()){ ?>
					<?php e($paginator->prev()); ?> &nbsp; <?php e($paginator->numbers()); ?> &nbsp; <?php e($paginator->next()); ?>
				<?php } ?>
			</div>
			
		</td>
	</tr>			
</table>