<?php
// app/Controller/PlacesController.php
class PlacesController extends AppController {
	//モデルの名前
	public $name = 'Places';
	//利用するモデルの指定
	public $uses = array('Place' , 'User' , 'Post');
	//ヘルパーの指定
	public $helpers = array('UploadPack.Upload');
	//ページネーションの設定
	public $paginate = array(
        'Place' => array(
            'limit' => 8, 
            'order' => array('Place.wifi_average_speed' => 'desc')
        )
    );

	//場所情報を全件だし
	public function index(){
		if(!empty($this->data)){
			//フォームが送信された場合の処理
			if($this->data['Place']['flg'] === "name_form"){
				//名前が検索条件だった場合
				if($this->data['Place']['name'] !== ""){
					//名前が入力されていた場合
					$this->paginate = array('conditions' => array('Place.name like ?' => array("%{$this->data['Place']['name']}%")));
		    	} else {
		    		//名前が入寮されていなかった場合
		    		//何も条件指定しないで全検索
		    	}
			} elseif ($this->data['Place']['flg'] === "other_form"){
				//それ以外の項目が検索条件だった場合
					$conditions = array(
					  	array( 'and' => 
					  		array(
					  				'Place.genre' => $this->data['Place']['genre'],
					  				'Place.wifi_average_speed >' => $this->data['Place']['wifi_average_speed'],
					  				'Place.wifi_existence' => $this->data['Place']['wifi_existence']
					  		)
					  	)
					);
					$this->paginate = array(
						'conditions' => $conditions,
						'order' => array('Place.wifi_average_speed' => 'desc'),
					);
					//ビューのラジオの初期値をセットする
					$this->set('value_genre' , $this->data['Place']['genre']);
					$this->set('value_wifi_average_speed' , $this->data['Place']['wifi_average_speed']);
					$this->set('value_wifi_existence' , $this->data['Place']['wifi_existence']);
			} 
		} else {
			//フォームが送信されていな場合
			//何も条件指定しないで全検索
		}
		//検索結果のレコードがあるかないかの判定
    	$data = $this->paginate('Place');
    	if($data == array()){
    		$record = false;
    	} else {
    		$record = true;
    	}
    	$this->set('record' , $record);

    	//検索結果が該当なしの場合
    	if($data == array()){
    		$this->Session->setFlash(__('該当の場所が見つかりませんでした。'));
    	}
		$this->set('data' , $data);
	}
	//場所情報を追加する
	public function add(){
		if($this->request->isPost()){
			$record = $this->data['Place'];
			$record['users_id'] =  $this->Auth->user('id');
			$flg = $this->Place->save($record);
			if($flg){
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	//場所情報を１件検索する
	public function show($param){
		//投稿の情報にページネーションをかけて渡す
		$this->paginate = array(
				'conditions' => array('Post.places_id' => $param),
				'order' => array('Post.created' => 'desc'),
				'limit' => 6
		);
		$data = $this->paginate('Post');
		//最後に投稿したユーザーを検索する
		$created_user = $this->Place->find('all' , array('conditions' => array('Place.id' => $param)));
		$created_user['id'] =  $created_user[0]['User']['id'];
		$created_user['username'] =  $created_user[0]['User']['username'];

		//投稿情報があった場合とない場合に分岐
		if(!empty($data)){
			//投稿情報と場所情報を渡す
			$this->set(compact('data' , 'created_user'));
		} else {
			//場所情報のみを渡す
			$data = $this->Place->find('all' , array('conditions' => array('Place.id' => $param)));
			$this->set(compact('data' , 'created_user'));
		}
	}

	//場所情報の編集画面
    public function edit($param = null){

    	if(isset($param)){
        	$data = $this->Place->find('all' , array('conditions' => array('Place.id' => $param)));
        	$data = $data[0];
        	$this->set('data' , $data); 		
    	} 

    	if($this->request->isPost()){
    		$data = $this->data;
    		$data['Place']['users_id'] = $this->Auth->user('id');
    		$data = $this->Place->save($data); 
    		if($data){
            	$this->set('data' , $data);
                $this->Session->setFlash(__('場所情報の更新が完了しました。'));
                $this->redirect(array('action'=>'show' , $data['Place']['id']));	
    		} else {
				$this->Session->setFlash(__('場所情報の更新に失敗しました。'));
    		} 
    	}
    }

}

?>