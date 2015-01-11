<?php

App::uses('Controller', 'Controller');

class UsersController extends AppController {
	//コントローラーの名前を書く
	public $name = 'Users';

	//使うコンポーネントの名前を書く
    public $components = array(
        'Session',

    );

    //ログインしていなくてもアクセス出来るメソッドを指定
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','logout');
    }

	//ログイン機能の実装
	public function login(){
		if($this->request->isPost()){
			if($this->Auth->login()){
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash('ユーザー名かパスワードが違います。','default',array(),'auth');
			}
		}
	}

	//ログアウト
	public function logout(){
		$this->Auth->logout();
		$this->redirect(array('action'=>'login'));
	}
	
	//ユーザー登録画面
	public function add(){
		if(!empty($this->data)){
			if($this->data){
				$this->User->create();
				$this->User->save($this->data);
				$this->redirect(array('action'=>'login'));
			}
		}
	}



}
