<?php
// app/Model/User.php
class User extends AppModel {
    //モデル名を宣言
    public $name = 'User';
    //バリデート
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'ユーザー名は必ず入力して下さい。'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'パスワードが違います。'
            )
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
                'styles' => array('thumb' => '85x85')
            )
        ),
    );
}