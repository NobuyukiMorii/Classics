<?php
// app/Controller/PlaceController.php
class PostsController extends AppController {
	//モデル名の指定
	public $name = 'Posts';
	//モデルの指定
	public $uses = array('Place' , 'User' ,'Post');
	//ヘルパーの指定
	public $helpers = array('UploadPack.Upload');
	
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
            $this->Session->setFlash(__('投稿しました。'));
		} else {
			$this->Session->setFlash(__('投稿に失敗しました。'));
		}
		$this->redirect(array('controller' => 'Places' , 'action'=>'show' , $data['Post']['places_id']));
	}

}

?>