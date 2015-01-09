<?php
// app/Model/User.php
class User extends AppModel {
    //バリデート
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        )
    );
    //保存する時のハッシュ化
    public function beforeSave(){
        $this->data['User']['password'] = 
            AuthComponent::password($this->data['User']['password']);
        return true;
    }

}