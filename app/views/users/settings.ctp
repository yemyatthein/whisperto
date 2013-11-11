<?php e($html->script("js_settings")); ?>
<table id='main' border='0' cellspacing='4'>
	<tr>
		<td align='center' valign='top' class='left_right_td_border'>
			<?php e($this->element('left', array('action'=>''))); ?>
		</td>
		<td valign='top' align='center' class='center_td_border'>
			<div class='new_whisper_box'>
				<table border='0' width='580px' cellspacing='0'>
					<tr>
						<td width='170' valign='top'>
							<div class='profile_info_box'>
								<?php echo $html->link($html->image('users/'.$user_info['User']['profile_image'], array('width'=>'150', 'height'=>'150')), '/users/profile/'.$user_info['User']['id'], array('escape'=>false)); ?>
								
								<div style='margin-top:20px;'>
									<div class='left_right_menu_item_container'>
										<?php e($this->Html->link('Change Profile Picture', '#', array('id'=>'ed_pict'))); ?>
									</div>
									<div class='left_right_menu_item_container'>
										<?php e($this->Html->link('Change Personal Data', '#', array('id'=>'ed_pdata'))); ?>
										<input type='hidden' id='user_of_interest' value='<?php echo $user_info['User']['id']; ?>'/>										
									</div>
								</div>
								<div class='basic_info_box'>
									<div class='individual_basic_info'>
										<div class='general_title'>Name:</div>
										<div class='basic_info_values'><span id='fn'><?php echo$user_info['User']['firstname'].'</span> <span id="sn">'.$user_info['User']['secondname'].'</span>'; ?></div>
									</div>
									<div class='individual_basic_info'>
										<div class='general_title'>Gender:</div>
										<div class='basic_info_values' id='gender'><?php echo $user_info['User']['gender']; ?></div>
									</div>
									<div class='individual_basic_info'>
										<div class='general_title'>Birthday:</div>
										<div class='basic_info_values' id='bd'><?php echo $user_info['User']['birthdate']; ?></div>
									</div>
									<div class='individual_basic_info'>
										<div class='general_title'>Email:</div>
										<div class='basic_info_values'><?php echo $user_info['User']['username']; ?></div>
									</div>
								</div>
							</div>
						</td>
						<td valign='top'>

							<div class='profile_friend_box'>								
								<div><div class='general_title'>About Me</div></div>
								<div class='profile_about_me'>
									<span id='abm'><?php e($user_info['User']['about']); ?></span>
									<?php e($this->Html->link('Change Information About Me', '#', array('id'=>'ed_about'))); ?>
								</div>
								
								<div id='edit_pane' class='friends_container' style='background-color:#BDBDBD'>
									
									<div id='aboutme_edit' class='edit_intenal'>
										<div class='general_title'>Change information about you</div>
										<? e($form->create('User', array('action'=>'update_settings/about'))); ?>
										<textarea name='data[User][content]' id='abm_content' class='about_me_content_input
'></textarea>
										<?php e($this->Form->button('Save Changes', array('class'=>'buttons'))); ?>
										<? e($form->end()); ?>
									</div>
									
									<div id='picture_edit' class='edit_intenal'>
										<div class='input_field_sep'>
											<div class='general_title'>Change profile picture</div>
										</div>
										<? e($form->create('User', array('action'=>'update_settings/pict', 'type' => 'file'))); ?>
										<div class='input_field_sep'>
											<?php e($form->file('File.Photo', array('name'=>'data[User][profile_image]'))); ?>
										</div>
										<div style='margin-top:15px; margin-left:22px;'>
											<?php e($this->Form->button('Save Changes', array('class'=>'buttons'))); ?>
										</div>
										<? e($form->end()); ?>
									</div>
									
									<div id='pdata_edit' class='edit_intenal'>
										<div class='input_field_sep'>
											<div class='general_title'>Change personal data</div>
										</div>
										<? e($form->create('User', array('action'=>'update_settings/pdata'))); ?>
										<div class='input_field_sep'>
											<label class='mini_instructions'>First Name: </label>
											<br/>
											<? e($form->text('firstname', array('id'=>'fname', 'name'=>'data[User][firstname]', 'class'=>'login_textbox'))); ?>
										</div>
										<div class='input_field_sep'>
											<label class='mini_instructions'>Last Name: </label>
											<br/>
											<? e($form->text('secondname', array('id'=>'sname', 'name'=>'data[User][secondname]', 'class'=>'login_textbox'))); ?>
										</div>
										<div class='input_field_sep'>
											<label class='mini_instructions'>Gender: </label>
											<br/>
											<?php
												$options = array('Male'=>"Male", 'Female'=>"Female");
												$attributes = array('id'=>'gender', 'name'=>'data[User][gender]', 'class'=>'radio_btn', 'label'=>'sp');
											?>
											<? e($form->radio('gender', $options, $attributes)); ?>
										</div>
										<div class='input_field_sep'>
											<label class='mini_instructions'>Birth Date: </label>
											<br/>
											<? e($form->input('User.birthdate', array('type'=>'date','minYear'=>1930, 'label'=>''))); ?>
										</div>
										<div style='margin-top:15px; margin-left:22px;'>
											<?php e($this->Form->button('Save Changes', array('class'=>'buttons'))); ?>
										</div>
										<? e($form->end()); ?>
									</div>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>			
</table>