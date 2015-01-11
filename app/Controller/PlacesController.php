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


}

?>