<?php
// app/Controller/PlaceController.php
class PostsController extends AppController {
	public $name = 'Posts';
	public $uses = array('Place' , 'User' ,'Post');

	public function index(){
		$data = $this->Post->find('all');
		pr($data);
	}

	public function add(){
		$data = $this->data;
		$data['Post']['users_id'] = $this->Auth->user('id');

		if(empty($this->data['Post']['comment'])){
			$this->Session->setFlash(__('コメントは必ず入力して下さい。'));
			$this->redirect(array('controller' => 'Places' , 'action'=>'show' , $data['Post']['places_id']));
		}

		$data = $this->Post->Save($data);
		if($data){
            $this->Session->setFlash(__('場所情報の更新が完了しました。'));
		} else {
			$this->Session->setFlash(__('場所情報の更新に失敗しました。'));
		}
		$this->redirect(array('controller' => 'Places' , 'action'=>'show' , $data['Post']['places_id']));
	}

}

?>