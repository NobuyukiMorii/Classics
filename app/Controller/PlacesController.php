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
            'order' => array('id' => 'asc')
        )
    );

	//場所情報を全件だし
	public function index(){
		if(isset($this->data)){
			if(!empty($this->data['Place']['name'])){
			    $this->paginate = array(
   					'conditions' => array('Place.name like ?' => array("%{$this->data['Place']['name']}%"))
				);
    		}
    	}
    	$data = $this->paginate('Place');

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
		$data = $this->Post->find('all' , array('conditions' => array('Post.places_id' => $param)));
		
		if(!empty($data)){
			$this->set('data' , $data);
		} else {
			$data = $this->Place->find('all' , array('conditions' => array('Place.id' => $param)));
			$this->set('data' , $data);
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