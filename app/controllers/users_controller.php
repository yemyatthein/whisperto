<?
class UsersController extends AppController{	
	
	var $name = 'Users';	
	var $helpers = array('Js' => array('Jquery'));
	var $components = array('RequestHandler', 'Email');
	var $uses = array('User', 'Notification', 'Invitation');
	var $paginate = array(
		'User' => array(
			'limit' => 20,
			'order' => array(
				'User.firstname' => 'asc'
			)
		)
	);
	
	function profile($pid=null){
		$current_user = $this->Auth->user();
		if($pid == null){
			$pid = $current_user['User']['id'];
		}
		$query = 'select * from users where id="'.$pid.'"';
		$user_info = $this->User->query($query);
		if(count($user_info)>0){
			$query = 'select * from users_users as uu where uu.user_id_1="'.$current_user['User']['id'].'" and uu.user_id_2="'.$pid.'" ';
			$relation = $this->User->Friend->query($query);
			$relation_status = null;
			if(count($relation)>0){
				$relation_status = $relation[0]['uu']['status'];
			}
			
			if($pid == $current_user['User']['id']){
				$relation_status = 5;
			}
			
			//$query = 'select * from users as u, users_users as uu where u.id=uu.user_id_2 and uu.user_id_1="'.$pid.'" and status="1" limit 20';
			//$friends = $this->User->Friend->query($query);
			
			$query = 'select user_id_2 from users_users where user_id_1='.$current_user['User']['id'].' and status=1';	
			$data = $this->User->Friend->query($query);
			$collection = $this->Common->singleColumnQueryResultIntoArray($data);
			
			$this->User->recursive = 0;		
			$friends = $this->paginate('User', array(
								'User.id' => $collection
							)
						);
			
			$this->set(array('user_info'=>$user_info, 'friends'=>$friends, 'relation_status'=>$relation_status));
		}
	}
	
	function ajax_get_user_friend(){
		$current_user = $this->Auth->user();
		
		if($this->RequestHandler->isAjax()) {
			$keyword = $_POST['keyword'];
			if($keyword != null && $keyword != '_all_'){
				$query = 'select id, firstname, secondname, profile_image from users as u, users_users as uu where u.id=uu.user_id_2 and status="1" and user_id_1='.$current_user['User']['id'].' and (firstname like "%'.$keyword.'%" or secondname like "%'.$keyword.'%")';
				$data = $this->User->query($query);
				//echo $data;
				echo json_encode($data);
			}
			else if($keyword == '_all_'){
					$query = 'select id, firstname, secondname, profile_image from users as u, users_users as uu where u.id=uu.user_id_2 and status="1" and user_id_1='.$current_user['User']['id'];
					$data = $this->User->query($query);
					//echo $data;
					echo json_encode($data);
			}
		}
		$this->autoRender = false;
	}
	
	function ajax_friendship_cases(){
		$current_user = $this->Auth->user();
		
		if($this->RequestHandler->isAjax()) {
			$tg = $_POST['tg'];
			$action = $_POST['action'];
			if($tg != null){
				if($action == 'add'){
					$query = 'insert into users_users values("'.$current_user['User']['id'].'", "'.$tg.'", "0")';
					$data = $this->User->query($query);
					$query = 'insert into users_users values("'.$tg.'", "'.$current_user['User']['id'].'", "2")';
					$data = $this->User->query($query);
					$time_created = date("Y-m-d H:i:s",time()-date("Z"));
					$query = 'insert into notifications values(NULL, 0, "'.$tg.'", "'.$current_user['User']['id'].'", "'.$time_created.'", 0)';
					$data = $this->Notification->query($query);					
					echo '0';
				}
				else if($action == 'remove_invitaton'){
					$query1 = 'delete from users_users where user_id_1="'.$current_user['User']['id'].'" and user_id_2="'.$tg.'"';					
					$query2 = 'delete from users_users where user_id_1="'.$tg.'" and user_id_2="'.$current_user['User']['id'].'"';
					$query3 = 'delete from notifications where user_to="'.$tg.'" and user_from="'.$current_user['User']['id'].'" and type=0';
					$data = $this->User->query($query1);
					$data = $this->User->query($query2);
					$data = $this->User->query($query3);
					echo '5';
				}
				else if($action == 'accept_invitaton'){
					$query1 = 'update users_users set status="1" where user_id_1="'.$current_user['User']['id'].'" and user_id_2="'.$tg.'"';					
					$query2 = 'update users_users set status="1" where user_id_1="'.$tg.'" and user_id_2="'.$current_user['User']['id'].'"';
					$query3 = 'insert into notifications values(NULL, 1, "'.$tg.'", "'.$current_user['User']['id'].'", "'.$time_created.'", 0)';
					
					$data = $this->User->query($query1);
					$data = $this->User->query($query2);
					$data = $this->User->query($query3);
					
					$results = array();
					$results['status'] = '1';
					$this->User->recursive = 0;
					$tgUserData = $this->User->findById($tg);
					$results['relInfo'] = $tgUserData;
					echo json_encode($results);
				}
			}
		}
		$this->autoRender = false;
	}
	
	function signup(){
		if(!empty($this->params['url']['scode']) && !empty($this->params['url']['mail'])){
			$scode = $this->params['url']['scode'];
			$email = $this->params['url']['mail'];
			$results = $this->Invitation->find('all', array(
					'fields' => array('user_id'),
					'conditions' => array(
						'md5' => $scode
					)
				)
			);
			if(empty($results)){
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			}
			$collection = $this->Common->singleColumnQueryResultIntoArray($results);
			$this->User->recursive = 0;
			$users = $this->User->find('all', array(
					'conditions' => array(
						'id' => $collection
					),
					'limit' => 6
				)
			);
			$this->set('users', $users);
			$this->set('email', $email);
			//var_dump($users);
		}
		else if(!empty($this->data)){			
			$this->User->create();
			$month = $this->data['User']['birthdate']['month'];
			$day = $this->data['User']['birthdate']['day'];
			$year = $this->data['User']['birthdate']['year'];
			$bd = $year.'-'.$month.'-'.$day;
			$this->data['User']['birthdate'] = $bd;
			if($this->User->save($this->data)){
				$this_id = $this->User->id;
				
				$email = $this->data['User']['username'];
				$results = $this->Invitation->find('all', array(
						'fields' => array('user_id'),
						'conditions' => array(
							'email' => $email
						)
					)
				);
				$collection = $this->Common->singleColumnQueryResultIntoArray($results);
				
				
				foreach($collection as $item){
					$query1 = 'insert into users_users values("'.$this_id.'", "'.$item.'", 1)';
					$query2 = 'insert into users_users values("'.$item.'", "'.$this_id.'", 1)';
					$time_created = date("Y-m-d H:i:s",time()-date("Z"));
					$query3 = 'insert into notifications values(NULL, "2", "'.$item.'", "'.$this_id.'", "'.$time_created.'", 0)';
					$query4 = 'delete from invitations where email="'.$email.'"';
					
					$this->User->query($query1);
					$this->User->query($query2);
					$this->User->query($query3);
					$this->User->query($query4);
				}
				
				$ext = substr($this->data['File']['Photo']['name'], strrpos($this->data['File']['Photo']['name'], '.') + 1);
				mkdir('img/users/user_id_'.$this_id.'_photos');
				
				if($this->data['File']['Photo']['name'] != ''){							
					$pimg_name = $this_id.'_profile.'.$ext;
					$profile_image = 'user_id_'.$this_id.'_photos/'.$pimg_name;						
					
					$this->Common->imageUpload('img/users/user_id_'.$this_id.'_photos/', $pimg_name, $ext, $this->data['File']['Photo']);
					
				}
				else{
					$profile_image = 'default.png';
				}
				$this->User->updateAll(
					array(
						'User.profile_image' => '"'.$profile_image.'"'
					),
					array(
						'User.id' => $this_id
					)
				);
				
				//$this->Session->setFlash('Your account is created.');
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			}
			else{
				$this->data = null;
			}			
		}
		else{
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
		$this->layout = 'signup_layout';
		
	}	
	
	function login(){	
		$this->layout = 'login_layout';
	}
	function logout(){	
		$this->Session->setFlash('Logout');
		$this->redirect($this->Auth->logout());
	}
	
	function friends(){
		$current_user = $this->Auth->user();
		
		$query = 'select user_id_2 from users_users where user_id_1='.$current_user['User']['id'].' and status=1';	
		$data = $this->User->Friend->query($query);
		$collection = $this->Common->singleColumnQueryResultIntoArray($data);
		
		$this->User->recursive = 0;		
		$result = $this->paginate('User', array(
							'User.id' => $collection
						)
					);
		$this->set('friends', $result);
	}
	
	function add_friend($fid=null){		
		$data = array(
			'UsersUser' => array(
				'user_id_1' => $this->Auth->user('id'),
				'user_id_2' => $fid
			)
		);
		$this->User->id = $this->Auth->user('id');
		$this->User->UsersUser->save($data);
		//$this->Session->setFlash('Success!');
		//$this->redirect(array('action' => 'home'));
	}
	
	function requests($fg=null){
		$current_user = $this->Auth->user();
	
		if($fg != null && $fg == 'sent')
		{
			$query = 'select user_id_1 from users_users where user_id_2='.$current_user['User']['id'].' and status=2';	
			$data = $this->User->Friend->query($query);
			$collection = $this->Common->singleColumnQueryResultIntoArray($data);
			
			$this->User->recursive = 0;
			$result = $this->User->find('all', array(
					'conditions' => array(
						'id' => $collection
					)
				)
			);
			$this->set('frequests', $result);
			$this->set('sent', true);
		}
		else{
			$query = 'select user_id_2 from users_users where user_id_1='.$current_user['User']['id'].' and status=2';	
			$data = $this->User->Friend->query($query);
			$collection = $this->Common->singleColumnQueryResultIntoArray($data);
			
			$this->User->recursive = 0;
			$result = $this->User->find('all', array(
					'conditions' => array(
						'id' => $collection
					)
				)
			);
			$this->set('frequests', $result);
			$this->set('sent', false);
		}
		
	}
	
	function accept_friendship($tg){
		$current_user = $this->Auth->user();
		$time_created = date("Y-m-d H:i:s",time()-date("Z"));
		$query1 = 'update users_users set status="1" where user_id_1="'.$current_user['User']['id'].'" and user_id_2="'.$tg.'"';					
		$query2 = 'update users_users set status="1" where user_id_1="'.$tg.'" and user_id_2="'.$current_user['User']['id'].'"';
		$query3 = 'insert into notifications values(NULL, 1, "'.$tg.'", "'.$current_user['User']['id'].'", "'.$time_created.'", 0)';
		
		$data = $this->User->query($query1);
		$data = $this->User->query($query2);
		$data = $this->User->query($query3);
		$this->redirect(array('controller'=>'users', 'action'=>'profile', $tg));
	}
	
	function find_people(){
		if(!empty($this->params['url']['friends_name'])){
			$q = $this->params['url']['friends_name'];
			if(!empty($q)){
				$current_user = $this->Auth->user();
				$query = 'select user_id_2 from users_users where user_id_1='.$current_user['User']['id'].' and status=1';	
				$data = $this->User->Friend->query($query);
				$collection = $this->Common->singleColumnQueryResultIntoArray($data);
				array_push($collection, $current_user['User']['id']);
				$this->User->recursive = 0;
				$results = $this->User->find('all', array(
								'conditions' => array(
									'OR' => array(
										'User.firstname LIKE' => '%'.$q.'%',
										'User.secondname LIKE' => '%'.$q.'%'
									),
									'NOT' => array(
										'User.id' => $collection
									)
								)
							)
						);
				$this->set('results', $results);
			}
			else{
				$this->set('results', null);
			}
		}
		else{
			$this->set('results', null);
		}
	}
	
	function notifications(){
		$current_user = $this->Auth->user();
		$ntf = $this->Notification->find('all', array(
						'conditions' => array(
							'Notification.user_to' => $current_user['User']['id']
						),
						'order by' => array(
							'Notification.time_created' => 'desc'
						)
					)
				);
		$this->set('ntf', $ntf);
		$query = 'update notifications set seen=1 where user_to="'.$current_user['User']['id'].'"';
		$this->User->query($query);
	}
	
	function settings(){
		$current_user = $this->Auth->user();
		$info = $this->User->findById($current_user['User']['id']);
		$this->set('user_info', $info);
	}
	
	function invite_people(){
		
	}
	
	function update_settings($type){
		$current_user = $this->Auth->user();
		if($type == 'about'){
			$about = $this->data['User']['content'];
			$this->User->updateAll(
					array(
						'User.about' => '"'.$about.'"'
					),
					array(
						'User.id' => $current_user['User']['id']
					)
				);
		}
		else if($type == 'pdata'){
			$this->data['User']['id'] = $current_user['User']['id'];
			$this->User->save($this->data);
		}
		else if($type == 'pict'){
			$this_id = $current_user['User']['id'];
			$ext = substr($this->data['User']['profile_image']['name'], strrpos($this->data['User']['profile_image']['name'], '.') + 1);
			
			if(file_exists('img/users/user_id_'.$this_id.'_photos'))
			{	
				$this->Common->deleteDir('img/users/user_id_'.$this_id.'_photos');
			}
			mkdir('img/users/user_id_'.$this_id.'_photos', 0777);
			
			if($this->data['User']['profile_image']['name'] != ''){							
				$pimg_name = $this_id.'_profile.'.$ext;
				$profile_image = 'user_id_'.$this_id.'_photos/'.$pimg_name;						
				
				$this->Common->imageUpload('img/users/user_id_'.$this_id.'_photos/', $pimg_name, $ext, $this->data['User']['profile_image']);
				
			}
			else{
				$profile_image = 'default.png';
			}
			$this->User->updateAll(
				array(
					'User.profile_image' => '"'.$profile_image.'"'
				),
				array(
					'User.id' => $this_id
				)
			);
		}
		$this->redirect(array('controller' => 'users', 'action' => 'settings'));
		//$this->autoRender = false;
	}
	
	function send_invitation(){
		$current_user = $this->Auth->user();
		$rt = array();
		$rt['Invitation']['user_id'] = $current_user['User']['id'];
		$rt['Invitation']['email'] = $this->data['User']['email'];
		$rt['Invitation']['md5'] = md5($this->data['User']['email']);
		$this->Invitation->create();
		if($this->Invitation->save($rt)){
			$content = '<p>Hi</p>';
			$content .= '<p>'.'<b>'.$current_user['User']['firstname'].' '.$current_user['User']['secondname'].'</b>'.' invited you to join WhisperTo Network. Click the following link to accept it.</p>';
			$content .= '<p>http://localhost/whisperto/users/signup?scode='.$rt['Invitation']['md5'].'</p>';
			$content .= '<p>WhisperTo</p>';
			$title = 'Invitation to WhisperTo';
			$to_email = $rt['Invitation']['email'].' <'.$rt['Invitation']['email'].'>';
			$this->Common->emailing($to_email, $title, $content);
		}
		//$this->Session->setFlash('Hello.');
		$this->redirect(array('controller' => 'users', 'action' => 'invite_people'));
	}
	
	function test(){
		var_dump(md5('yemyatthein@gmail.com'));
		var_dump($this->params['url']);
		$this->autoRender = false;
	}
	
}
?>