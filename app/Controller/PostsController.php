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
		//投稿内容の保存
		$data = $this->Post->Save($data);
			//エラー表示
		if($data){
            $this->Session->setFlash(__('投稿しました。'));
		} else {
			$this->Session->setFlash(__('投稿に失敗しました。'));
		}
		//wifiスピードの平均を計算
		$past_post = $this->Post->find(
			'all' , 
			array(
				'conditions' => array('Post.places_id' => $data['Post']['places_id']) ,
				'fields' => array('Post.wifi_speed')
			)
		);
		$wifi_sum_speed = 0;
		for($i = 0; $i <count($past_post); $i++){
			$wifi_sum_speed += $past_post[$i]['Post']['wifi_speed'];
		}
		$wifi_average_speed = round( $wifi_sum_speed / count($past_post) , 2);
		//Placeへのwifi_average_speedの保存
		$update_place = $this->Place->find('all' , array('conditions' => array('Place.id' => $data['Post']['places_id'])));
		$this->Place->id = $update_place[0]['Place']['id'];
		$flg = $this->Place->saveField('wifi_average_speed' , $wifi_average_speed);

		if($flg = false){
			$this->Session->setFlash(__('wifiスピードの更新に失敗しました。'));
		}
		
		$this->redirect(array('controller' => 'Places' , 'action'=>'show' , $data['Post']['places_id']));
	}

}

?>