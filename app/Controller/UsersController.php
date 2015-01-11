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

	//ユーザー確認画面（みんな見れる）
	public function show($param){
		$data = $this->User->find('all' , array('conditions' => array('User.id' => $param)));
		$this->set('data' , $data);
	}

	//ユーザー確認画面（ログインユーザーのみ）
	public function profile(){
		$id = $this->Auth->user('id');
		if(!empty($id)){
            $data = $this->User->find('all' , array('conditions' => array('User.id' => $id)));
            if($data){
            	$this->set('data' , $data);
            } 
        } else {
            $this->Session->setFlash(__('ログインしなおして下さい。'));
            $this->redirect(array('controller' => 'Users' , 'action' => 'login'));
        }
	}

	//ユーザー編集画面（ログインユーザーのみ）
    public function edit(){
    	$info = $this->data;
		$info['User']['id'] = $this->Auth->user('id');

		//更新の処理
		if(!empty($this->data)){
            if ($data[0] = $this->User->save($info)) {
            	$this->set('data' , $data);
                $this->Session->setFlash(__('ユーザー情報の更新が完了しました。'));
            } else {
                $this->Session->setFlash(__('ユーザー情報の更新に失敗しました。'));
            }
        } else {
        	$data = $this->User->find('all' , array('conditions' => array('User.id' => $info['User']['id'])));
        	$this->set('data' , $data);
        }
    }

    //退会するメソッド（ログインユーザーのみ）
    public function delete(){
    	$flg = $this->User->delete($this->Auth->user('id'));
		if($flg){
			$this->Session->setFlash(__('退会しました。'));
			$this->redirect(array('controller' => 'Users' , 'action' => 'login'));
		} 
		if(!$flg){
			$this->Session->setFlash(__('退会出来ませんでした。もう一度退会ボタンを教えて下さい。'));
		}


    }

}
