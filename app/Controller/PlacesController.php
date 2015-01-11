<?php
// app/Controller/PlaceController.php
class PlacesController extends AppController {
	public $name = 'Places';
	public $uses = array('Place' , 'User');

	public function index(){
		$data = $this->Place->find('all' , array('order' => 'Place.id desc'));
		$this->set('data',$data);
	}

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

	public function show($param){
		$data = $this->Place->find('all' , array('conditions' => array('Place.id' => $param)));
		$this->set('data',$data);
	}

	//場所情報の編集画面
    public function edit($param = null){

		//もしパラメータがついてたら、フォームのバリュを設定して
		//もそうじゃなくて、ポストされたら、セーブする。かつ、編集画面にリダイレクトする
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