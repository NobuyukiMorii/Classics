<?php
// app/Controller/PlaceController.php
class PostsController extends AppController {
	public $name = 'Posts';
	public $uses = array('Place' , 'User' ,'Post');

	public function index(){
		$data = $this->Post->find('all');
		pr($data);
	}

}

?>