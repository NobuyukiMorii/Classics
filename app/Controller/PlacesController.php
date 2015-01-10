<?php

class PlacesController extends AppController {
	public $name = 'Places';
	public $uses = array('Place');

	public function index(){
		$data = $this->Place->find('all');
		$this->set('data',$data);
	}

}

?>