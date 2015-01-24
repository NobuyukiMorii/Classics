<?php
// app/Controller/UserController.php
App::uses('Controller', 'Controller');

class UsersController extends AppController {
	//コントローラーの名前を書く
	public $name = 'Users';
	//使用するモデルを指定する
	public $uses = array('Place' , 'User' , 'Post');
	//ヘルパーの設定
	public $helpers = array('UploadPack.Upload');
	//ページネーションの設定
	public $paginate = array(
        'User' => array(
            'limit' => 10, 
            'order' => array('User.wifi_average_speed' => 'desc')
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
		//レイアウトは使わないと指定
		$this->layout = "";
		//ログイン処理
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
		//レイアウトをナビバーがないパターンに変更
		$this->layout = 'non-nav';
		//ユーザー登録処理
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
		$this->Place->unbindModel(array('belongsTo' => array('User')));
		$data_place = $this->Place->find('all' , array('conditions' => array('Place.users_id' => $param)));
		//ユーザー情報のデータ
		$data_user = $this->User->find('all' ,  array('conditions' => array('User.id' => $param)));
		//投稿情報
		$this->Post->unbindModel(array('belongsTo' => array('Place' , 'User')));
		$data_post = $this->Post->find('all' , array('conditions' => array('Post.users_id' => $param)));
		//データをビューに渡す
		$this->set(compact('data_place' , 'data_user' , 'data_post'));
	}

	//ユーザー確認画面（ログインユーザーのみ）
	public function profile(){
		$id = $this->Auth->user('id');
		if(!empty($id)){
			$data_place = $this->Place->find('all' , array('conditions' => array('Place.users_id' => $id)));
			//ユーザー情報のデータ
			$data_user = $this->User->find('all' ,  array('conditions' => array('User.id' => $id)));
			//投稿情報
			$this->Post->unbindModel(array('belongsTo' => array('Place' , 'User')));
			$data_post = $this->Post->find('all' , array('conditions' => array('Post.users_id' => $id)));
			//データをビューに渡す
			$this->set(compact('data_place' , 'data_user' , 'data_post'));
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
                $this->redirect(array('controller' => 'Users' , 'action' => 'profile'));
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
				//フォームが送信されていたら条件をつけて
			    $this->paginate = array(
   					'conditions' => array('User.username like ?' => array("%{$this->data['User']['username']}%"))
				);
    		}
    	}
    	//フォームが送信sされていなければ、条件をつけずに検索する
    	$data = $this->paginate('User');
    	//検索結果が該当なしの場合
    	if($data == array()){
    		$this->Session->setFlash(__('該当のユーザーが見つかりませんでした。'));
    	}
    	$this->set('data' , $data);
    }

    //問い合わせ画面
    public function inquiry(){
    	//ビューを表示するためにメソッドのみ用意
    }
    //サイト紹介画面
    public function service_information(){
    	//ビューを表示するためにメソッドのみ用意
    }
}
