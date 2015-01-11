<?php
// app/Controller/UserController.php
App::uses('Controller', 'Controller');

class UsersController extends AppController {
	//コントローラーの名前を書く
	public $name = 'Users';
	//使用するモデルを指定する
	public $uses = array('Place' , 'User');

	//使うコンポーネントの名前を書く
    public $components = array(
        'Session'
    );
    //ログインしていないユーザーのアクセスを許可するメソッドを指定
	public function beforeFilter() {
	    parent::beforeFilter();
	    // ユーザー自身による登録とログアウトを許可する
	    $this->Auth->allow('add', 'logout', 'login');
	}
	//ログイン機能の実装
	public function login(){
		if($this->request->isPost()){
			if($this->Auth->login()){
				$this->redirect(array('controller' => 'Places' , 'action' => 'index'));
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

	//ユーザー詳細情報確認画面
	public function show($param){
		$data = $this->User->find('all' , array('conditions' => array('User.id' => $param)));
		$this->set('data' , $data);
	}

	//ユーザー編集画面
    public function edit() {
		if(!empty($this->data)){
			$info = $this->data;
			$info['User']['id'] = $this->Auth->user('id');
            if ($this->User->save($info)) {
                $this->Session->setFlash(__('ユーザー情報の更新が完了しました。'));
                $this->redirect(array('controller' => 'Places' , 'action' => 'index'));
            } else {
                $this->Session->setFlash(__('ユーザー情報の更新に失敗しました。'));
            }
        }
    }



}
