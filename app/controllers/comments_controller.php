<?php
class CommentsController extends AppController{
	
	var $name = 'Comments';
	var $components = array('RequestHandler');
	
	function ajax_add_comment(){
		$current_user = $this->Auth->user();
		App::import('Helper', 'Time');
		$time = new TimeHelper();
		if($this->RequestHandler->isAjax()) {
			$content = $_POST['comment'];
			$user_id = $current_user['User']['id'];
			$user_image = $current_user['User']['profile_image'];
			$username = $current_user['User']['firstname'].' '.$current_user['User']['secondname'];
			$whisper_id = $_POST['whisper_id'];
			$time_created = date("Y-m-d H:i:s",time()-date("Z"));
			$data = array('content'=>$content, 'time_created'=>$time_created, 'whisper_id'=>$whisper_id, 'user_id'=>$user_id);
			if($this->Comment->save($data)){
				$comment_id = $this->Comment->id;
				$data['username'] = $username;
				$data['user_image'] = $user_image;
				$data['time_display'] = $time->nice($time_created);
				
				
				$query = 'select * from users_whispers uw, users as u where uw.user_id=u.id and uw.whisper_id="'.$whisper_id.'" and uw.user_id<>"'.$current_user['User']['id'].'" and uw.interested="1"';
				$response_notify = $this->Comment->On->VisibleTo->query($query);
					
				for($i=0; $i<count($response_notify); $i++){
					$to_id = $response_notify[$i]['uw']['user_id'];
					$data_notify = array('user_id'=>$to_id, 'comment_id'=>$comment_id, 'for_cake'=>$to_id.'-'.$comment_id);
					$this->Comment->ToNotify->save($data_notify);
				}
				
				echo json_encode($data);
			}
		}
		$this->autoRender = false;
	}
	
	function comment(){	
		$current_user = $this->Auth->user();
		if(!empty($this->data)){
			$current = date("Y-m-d H:i:s",time()-date("Z"));
			$this->data['Comment']['user_id'] = $this->Auth->user('id');
			$this->data['Comment']['time_created'] = $current;			
						
			if($this->Comment->save($this->data)){
					$t2 = $this->Comment->On->VisibleTo->find('all', array(
								'fields' => array('VisibleTo.user_id'),
								'conditions' => array(
									'VisibleTo.whisper_id' => $this->data['Comment']['whisper_id']
								)
							)
						);
					foreach($t2 as $item){
						$comment_id = $this->Comment->id;
						$user_id = $item['VisibleTo']['user_id'];
						if($user_id != $current_user['User']['id']){
							$this->Comment->ToNotify->create();
							$data = array('user_id' => $user_id, 'comment_id' => $comment_id);
							$this->Comment->ToNotify->save($data);
						}
					}
				$this->Session->setFlash('You have commented on the whisper');
				$this->redirect(array('controller' => 'whispers', 'action' => 'view', $this->data['Comment']['whisper_id']));
			}
		}
	}
}
?>