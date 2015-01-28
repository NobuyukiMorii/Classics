<?php
// app/Model/User.php
class User extends AppModel {
    //モデル名を宣言
    public $name = 'User';
    //バリデート
    public $validate = array(
        'username' => array(
            'rule' => 'notEmpty' ,
            'message' => 'ユーザー名は必ず入力して下さい。'
        ),
        'password' => array(
            'rule' => 'notEmpty' ,
            'message' => 'パスワードは必ず入力して下さい。'
        )
    );
    //保存する時のハッシュ化
    public function beforeSave(){
        $this->data['User']['password'] = 
            AuthComponent::password($this->data['User']['password']);
        return true;
    }
    //UploadPackの設定
    public $actsAs = array(
        'UploadPack.Upload' => array(
            'avatar' => array(
                'quality' => 95 ,
                'styles' => array('thumb' => '170x170')
            )
        ),
    );
}