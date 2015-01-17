<?php
// app/Controller/UserController.php
App::uses('Controller', 'Controller');

class UsersController extends AppController {
	//コントローラーの名前を書く
	public $name = 'Users';
	//使用するモデルを指定する
	public $uses = array('Place' , 'User');
	//ヘルパーの設定
	public $helpers = array('UploadPack.Upload');
	//ページネーションの設定
	public $paginate = array(
        'User' => array(
            'limit' => 8, 
            'order' => array('id' => 'asc')
        )
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
		//場所情報のデータ
		$data_place = $this->Place->find('all' , array('conditions' => array('Place.users_id' => $param)));
		//ユーザー情報のデータ
		$data_user = $this->User->find('all' ,  array('conditions' => array('User.id' => $param)));
		//データをビューに渡す
		$this->set(compact('data_place' , 'data_user'));
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
    	//退会者のユーザーネームを統一化し、パスワードはランダムにする
    	$data = null;
    	$data['User']['id'] = $this->Auth->user('id');
    	$data['User']['username'] = "退会者" ;
    	$data['User']['password'] = rand(1, 5);

    	$flg = $this->User->save($data);
		if($flg){
			$this->Session->setFlash(__('退会しました。'));
			$this->redirect(array('controller' => 'Users' , 'action' => 'login'));
		} 
		if(!$flg){
			$this->Session->setFlash(__('退会出来ませんでした。もう一度退会ボタンを押して下さい。'));
		}
    }

    //全ユーザーを表示する画面を作成する
    public function serchUser(){
		if(isset($this->data)){
			if(!empty($this->data['User']['username'])){
			    $this->paginate = array(
   					'conditions' => array('User.username like ?' => array("%{$this->data['User']['username']}%"))
				);
    		}
    	}
    	$data = $this->paginate('User');
    	//検索結果が該当なしの場合
    	if($data == array()){
    		$this->Session->setFlash(__('該当のユーザーが見つかりませんでした。'));
    	}
    	$this->set('data' , $data);
    }
}
