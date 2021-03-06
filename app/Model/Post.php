<?php
// app/Model/Post.php
class Post extends AppModel {
	public $name = 'Post';

	//バリデーションの設定

	public $validate = array(
		'comment' => array(
			'rule' => 'notEmpty' ,
			'message' => '内容は必ず入力して下さい。'
		),
		'wifi_speed' => array(
			array(
				'rule' => array('range', 0, 99),
				'message' => '０〜９９までの範囲で入力して下さい'
			),
			array(
				'rule' => array('decimal', 2),
				'message' => '小数点以下2桁まで入力して下さい。',
			)
		),
		'time_zone' => array(
			'rule' => 'alphaNumeric' ,
			'message' => 'ラジオボタンから選択して下さい。'
		),
		'payment' => array(
			'rule' => 'alphaNumeric' ,
			'message' => 'ラジオボタンから選択して下さい。'
		)	
	);

	//場所情報は、ユーザー情報に属する
	public $belongsTo = array(
		"Place" => array(
			'className' => 'Place' ,
			'condition' => '' ,
			'order' => '' ,
			'dependent' => false ,
			'foreignKey' => 'places_id'
		),
		"User" => array(
			'className' => 'User' ,
			'condition' => '' ,
			'order' => '' ,
			'dependent' => false ,
			'foreignKey' => 'users_id'
		),

	);
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