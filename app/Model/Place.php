<?php
// app/Model/Place.php
class Place extends AppModel {
	public $name = 'Place';

	public $validate = array(
		'name' => array(
			array(
				'rule' => 'notEmpty' ,
				'message' => 'タイトルは必ず入力して下さい。'
			),
			array(
                'rule' => 'isUnique',
                'message' => 'この場所は既に登録されています'
			)
		),
		'comment' => array(
			'rule' => 'notEmpty' ,
			'message' => '内容は必ず入力して下さい。'
		)
	);
	//場所情報は、ユーザー情報に属する
	public $belongsTo = array(
		"User" => array(
			'className' => 'User' ,
			'condition' => '' ,
			'order' => '' ,
			'dependent' => false ,
			'foreignKey' => 'users_id'
		)
	);

}