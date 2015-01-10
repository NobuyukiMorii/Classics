<?php

class PlacesController extends AppController {
	public $name = 'Places';
	public $uses = array('Place');
	//インデックスメソッッド
	public function index(){
		//全てのデータを検索する
		$data = $this->Place->find('all');
		$this->set('data',$data);
		//idでデータを検索する
		$id_number = null;
		if(!empty($this->data)){
			$id_number = $this->Place->find(
				'all',
				array('conditions'=>array('Place.id'=>$this->data['Place']['id']))
			);
		} else {
			$id_number = $this->Place->find('all');
		}
		$this->set('id_number',$id_number);
	}
	//追加用メソッド
	public function addRecord(){
		if(!empty($this->data)){
			$this->Place->save($this->data);
		}
		$this->redirect('index');
	}
	//削除用メソッド
	public function delRecord(){
		if(!empty($this->data)){
			$this->Place->delete($this->data['Place']['id']);
		}
		$this->redirect('index');
	}

}

?>