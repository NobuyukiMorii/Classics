<?php
// app/Controller/PlaceController.php
class PlacesController extends AppController {
	public $name = 'Places';
	public $uses = array('Place' , 'User');

	//場所情報を全県だし
	public function index(){

		if($this->request->isPost()){

			if(!empty($this->data['Place']['name'])){
				$data = $this->Place->find('all' , array('conditions' => array('Place.name' => $this->data['Place']['name'])));
				$this->set('data');
			} else {
				$data = $this->Place->find('all' , array('order' => 'Place.id desc'));
				$this->set('data' , $data);	
			}
		} else {
			$data = $this->Place->find('all' , array('order' => 'Place.id desc'));
			$this->set('data' , $data);
		}
	}
	//場所情報を追加する
	public function add(){
		if($this->request->isPost()){
			$record = $this->data['Place'];
			$record['users_id'] =  $this->Auth->user('id');
			$flg = $this->Place->save($record);
			if($flg){
				$this->redirect(array('action'=>'index'));
			}
		}
	}

	//場所情報を１件検索する
	public function show($param){
		$data = $this->Place->find('all' , array('conditions' => array('Place.id' => $param)));
		$this->set('data',$data);
	}

	//場所情報の編集画面
    public function edit($param = null){

    	if(isset($param)){
        	$data = $this->Place->find('all' , array('conditions' => array('Place.id' => $param)));
        	$data = $data[0];
        	$this->set('data' , $data); 		
    	} 

    	if($this->request->isPost()){
    		$data = $this->Place->save($this->data); 
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