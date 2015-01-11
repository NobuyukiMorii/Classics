<?php
// app/Controller/PlaceController.php
class PlacesController extends AppController {
	public $name = 'Places';
	public $uses = array('Place' , 'User');

	public function index(){
		$data = $this->Place->find('all' , array('order' => 'Place.id desc'));
		$this->set('data',$data);
	}



}

?>