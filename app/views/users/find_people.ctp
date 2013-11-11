<?php e($html->script("js_find_ppl")); ?>
<table id='main' border='0' cellspacing='4'>
	<tr>
		<td align='center' valign='top' class='left_right_td_border'>
			<?php e($this->element('left', array('action'=>''))); ?>
		</td>
		<td valign='top' align='center' class='center_td_border'>
			<div class='main_content_title_container'>
				Find New Friends
			</div>
			<div class='read_item_in_whisper_list' style='padding-top:10px; padding-bottom:10px;'>
				<? e($this->Form->create('User', array('action'=>'find_people', 'type'=>'get'))); ?>
				Type the name of person:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php e($this->Form->text('friends_name', array('id'=>'friends_name', 'style'=>'height:20px'))); ?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input id='search_ppl' style='height:28px' type='submit' value='Search' />
				<? e($this->Form->end()); ?>
			</div>
			<div class='friends_container' style='margin-left:10px; text-align:left; border-color:#6E6E6E; margin-top:10px; padding-left:10px; padding-top:10px; background-color: #FFF; min-height: 450px;'>
				<?php 
				if($results != null && count($results)<1){
					e('No results.');
				} 
				else if($results != null && count($results)>0){ ?>
					<table border='0' cellspacing='0'>
						<tr>
						<?php 
						for($i=0; $i<count($results); $i++){ 
							if($i != 0 && $i%6 == 0){
								echo '</tr><tr>';
							}
						?>
							<td>
								<div class='individual_profile_icon'>
									<?php echo $html->link($html->image('users/'.$results[$i]['User']['profile_image'], array('width'=>'65', 'height'=>'65')), '/users/profile/'.$results[$i]['User']['id'], array('escape'=>false)); ?>
									<div class='individual_profile_name'>
										<?php echo $html->link($results[$i]['User']['firstname'].' '.$results[$i]['User']['secondname'],'/users/profile/'.$results[$i]['User']['id']); ?>
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
				<?php } ?>
			</div>
		</td>
	</tr>			
</table>