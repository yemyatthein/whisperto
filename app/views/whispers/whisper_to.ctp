<div class='container'>
	<table border='0' cellspacing='0'>
		<tr>
			<td class='main_table_cell'>
				<div class='current_user_info'>					
					<?php e($html->image('user.jpg', array('class' => 'profile_image'))); ?>
					<div class='profile_user_name'>
						<?php e($html->link($userdata['name'], '/users/profile/'.$userdata['userid'])); ?>
					</div>
					<div class='buttons_in_profile_info'>						
						<?php e('<p>'.$html->link('My Profile', '/users/profile/'.$userdata['userid']).'</p>'); ?>
						<?php e('<p>'.$html->link('My Friends', '/users/friends').'</p>'); ?>
					</div>
				</div>
			</td>
			<td class='main_table_cell'>
				<div class='dynamic_content_area'>
					<div class='title'>
						Whisper
					</div>
					<div class='whisper_container'>						
						<?php e($form->create('Whisper', array('action' => 'whisper_to')));?>
						<div class='actual_whisper_container'>							
							<?php e($form->textarea('content', array('class' => 'whisper_for_real'))); ?>
							<hr/>							
							<div class='to_people'>
								<div class='in_message'>Choose at least one recipient.</div>
								<div class='to_people_box'>
									<table border='0' cellspacing='0'>
										<tr>
										<?php
										for($i=0; $i<count($users); $i++){
											if($i%6 == 0){
												e('</tr><tr>');											
										?>
												<td class='inside_to_people_image'>						
													<?php
													e($form->checkbox('VT.VT. ', array(
																	'id' => 'user_'.$users[$i]['User']['id'],
																	'value' => $users[$i]['User']['id'],
																	'hiddenField' => false
																)
															)
													);
													e($html->image($users[$i]['User']['profile_image'], array('class' => 'img_to_people', 'width' => '40', 'height' => '40'))); ?>
												</td>
											<?
											} else{
											?>
												<td class='inside_to_people_image'>										
													<?php 
													e($form->checkbox('VT.VT. ', array(
																	'id' => 'user_'.$users[$i]['User']['id'],
																	'value' => $users[$i]['User']['id'],
																	'hiddenField' => false
																)
															)
													);
													e($html->image($users[$i]['User']['profile_image'], array('class' => 'img_to_people', 'width' => '40', 'height' => '40'))); ?>
												</td>
										<?	}
										}
										?>										
										</tr>
									</table>									
								</div>
							</div>							
							
							<hr/>
							<div class='whisper_button_container'>								
								<?php e($form->button('Whisper', array('type'=>'submit', 'class' => 'whisper_button'))); ?>
							</div>
							
						</div>
						<?php e($form->end()); ?>
					</div>
					<div class='inside_menu'>
						<table align='center' border='0' cellspacing='0'>
							<tr>
								<td></td>
								<td class='inside_menu_cell_notf'><div class='notification_symbol'>10</div></td>
								<td></td>								
								<td class='inside_menu_cell_notf'><div class='notification_symbol'>10</div></td>
							</tr>
							<tr>
								<td class='inside_menu_cell'>	
									<a href='#'><?php e($html->image('all.jpg', array('class' => 'inside_menu'))); ?></a>
									<div class='inside_menu_links'>
										<a href='#'>All</a>
									</div>
								</td>								
								<td class='inside_menu_cell'>
									<a href='#'><?php e($html->image('in.jpg', array('class' => 'inside_menu'))); ?></a>
									<div class='inside_menu_links'>
										<a href='#'>Inbox</a>
									</div>
								</td>
								<td class='inside_menu_cell'>
									<a href='#'><?php e($html->image('out.jpg', array('class' => 'inside_menu'))); ?></a>
									<div class='inside_menu_links'>
										<a href='#'>Outbox</a>
									</div>
								</td>
								<td class='inside_menu_cell'>
									<a href='#'><?php e($html->image('response.png', array('class' => 'inside_menu'))); ?></a>
									<div class='inside_menu_links'>
										<a href='#'>Responses</a>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>
