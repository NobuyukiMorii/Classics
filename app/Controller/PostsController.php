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
		$places_id = $data['Post']['places_id'];

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
			$this->redirect(array('controller' => 'Places' , 'action'=>'show' , $places_id));
		}
		//アップデート対象となる投稿情報を取得
		$past_post = $this->Post->find(
			'all' , 
			array(
				'conditions' => array('Post.places_id' => $data['Post']['places_id'] , 'NOT' => array('Post.wifi_speed' => 0)) ,
				'fields' => array('Post.wifi_speed' , 'Post.payment')
			)
		);
		//アップデート対象レコードの平均を計算
		$wifi_speed_sum = 0;
		$payment_sum = 0;
		for($i = 0; $i <count($past_post); $i++){
			//wifiスピードの合計値
			$wifi_speed_sum += $past_post[$i]['Post']['wifi_speed'];
			//支払額の合計値
			$payment_sum += $past_post[$i]['Post']['payment'];
		}
		//0で割らないための処理
		if(count($past_post) !== 0){
			$wifi_average_speed = round($wifi_speed_sum / count($past_post) , 2);
		} else {

		}
		$payment_average = round($payment_sum / count($past_post) , 2);

		//Placeへのwifi_average_speedの保存
		$update_place = $this->Place->find('all' , array('conditions' => array('Place.id' => $data['Post']['places_id'])));
		$this->Place->id = $update_place[0]['Place']['id'];
		$flg1 = $this->Place->saveField('wifi_average_speed' , $wifi_average_speed);
		$flg2 = $this->Place->saveField('payment_average' , $payment_average);
		//エラー表示
		if($flg1 == false || $flg2 == false){
			$this->Session->setFlash(__('wifiスピードの更新に失敗しました。'));
		}

		$this->redirect(array('controller' => 'Places' , 'action'=>'show' , $data['Post']['places_id']));
	}

}

?>