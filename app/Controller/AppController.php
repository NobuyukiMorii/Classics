<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller' , 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	//ヘルパーの設定
	public $helpers = array('Html' , 'Form');

	//コンポーネントの設定
	public $components = array(
        //Authの設定
        'Auth' => array(
            //ログインしていない時のエラーメッセージを指定
        	'authError' => 'ログインしてください。',
                        //ログイン後のリダイレクト先を指定
            'loginRedirect' => array('controller' => 'Places', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'Users', 'action' => 'login'),
        ),
        //デバッグキット使う
		'DebugKit.Toolbar'
	);

	//ビフォアーフィルターの設定
	public function beforeFilter(){
    	//エラーメッセージ
        $this->Auth->AuthError = "あなたはログインしていません。";
	}

}
