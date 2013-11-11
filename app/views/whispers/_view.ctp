<?php e($html->script("js_whisper_view")); ?>
<div class='back_of_rounded_1'>	
	<div class='container'>	
		<table border='0' cellspacing='0'>
			<tr>
				<td class='main_table_cell'>
					<?php e($this->element('current_user_info_box', array("userdata" => $userdata))); ?>
				</td>
				<td class='main_table_cell'>
					<div class='dynamic_content_area'>
						
						<div class='whisper_container'>
							<div class='title_whisper_to'>
								<?php e($html->link($results[0]['CreatedBy']['firstname'].' '.$results[0]['CreatedBy']['secondname'].' :','/users/profile/'.$results[0]['CreatedBy']['id'])); ?>
							</div>
							
							<div class='message_display'>
								<?php e($results[0]['Whisper']['content']); ?>
							</div>
							
							<div class='recipient_display'>
								<table border='0' cellspacing='0'>
									<tr>										
										<?php 
										foreach($results[0]['VisibleTo'] as $element){
											if($results[0]['CreatedBy']['id'] != $element['User']['id']){
												e('<td class="inside_to_people_image">');
													e($html->link($html->image($element['User']['profile_image'], array('class' => 'img_to_people', 'width' => '30', 'height' => '30')), '/users/profile/'.$element['User']['id'], array('escape'=>false)));
													e('<div class="fname">');
														e($html->link($presentation->shortenString($element['User']['firstname'], 6), '/users/profile/'.$element['User']['id'], array('escape'=>false)));
													e('</div>');
												e('</td>');
											}
										} 
										?>
									</tr>
								</table>
							</div>
							
							<?php foreach($results[0]['Comment'] as $element){ ?>
								<div class='comment_container'>
									<table border='0' cellspacing='0'>
										<tr>
											<td valign='top'>
												<?php													
													e($html->link($html->image($element['By']['profile_image'], array('class' => 'img_to_people', 'width' => '30', 'height' => '30')), '/users/profile/'.$element['By']['id'], array('escape'=>false)));						
												?>
											</td>
											<td valign='top'>
												<div class='comment_content'>
													<?php 
														e('<span class="fname">'.$html->link($presentation->shortenString($element['By']['firstname'], 6), '/users/profile/'.$element['By']['id'], array('escape'=>false)).'</span> ');
														e($element['content']); 
													?>
													<div class='time_display'>
														<?php e($time->nice($element['time_created'])); ?>
													</div>
												</div>
											</td>
										</tr>
									</table>
								</div>
							<?php } ?>
							<div id='for_show_box' class='comment_container'>
								<input type='text' class='comment_for_show' />
								<table class='comment_for_real' border='0' cellspacing='0'>
									<tr>
										<td valign='top'>
											<?php
												e($html->link($html->image($userdata['profile_image'], array('class' => 'img_to_people', 'width' => '30', 'height' => '30')), '/users/profile/'.$userdata['userid'], array('escape'=>false)));
											?>
										</td>
										<td valign='top'>
											<div class='comment_content'>
												<?php e($form->create('Comment', array('action' => 'comment'))); ?>
												<?php e($form->input( 'whisper_id', array( 'value' => $results[0]['Whisper']['id']  , 'type' => 'hidden' ) ) ); ?>
												<?php e($form->textarea('content', array('class' => 'comment_for_real'))); ?>
												<?php e('<div class="comment_button_container">'); ?>
												<?php e($form->button('Comment', array('id' => 'comment', 'type'=>'submit', 'class' => 'comment_button'))); ?>
												<?php e('</div>'); ?>
												<?php e($form->end()); ?>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
						
					</div>
				</td>
			</tr>
		</table>	
	</div>
</div>
