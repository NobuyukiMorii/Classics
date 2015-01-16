<?php
// app/Model/Post.php
class Post extends AppModel {
	public $name = 'Post';

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
                'styles' => array('thumb' => '85x85')
            )
        ),
    );

}