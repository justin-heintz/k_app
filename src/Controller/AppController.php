<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class AppController extends Controller{
	public $authUser;
    public $userTypes;
	public function initialize(): void{
        parent::initialize();
		$this->loadComponent('RequestHandler');
		$this->loadComponent('Flash');
		
		$this->authUser = $this->request->getSession();
		$this->userTypes = ['Users', 'Customers', 'Partners', 'Affiliates'];
    }
	public function beforeRender(EventInterface  $event){
		parent::beforeRender($event);

		
		$action = $this->request->getParam('action');
		$controller = $this->request->getParam('controller');
		$type = 'null';
		
		if($this->authUser->check('type')){
			$type = $this->userTypes[ $this->authUser->read('type') ];
		 }

		$isAuth = [
			'Users'=>[
				'Users'=>['index'=>true, 'register'=>true, 'add'=>true, 'edit'=>true, 'delete'=>true, 'login'=>true]
			],
			'Customers'=>[],
			'Partners'=>[],
			'Affiliates'=>[],
			'Admins'=>[],
			'null'=>[
				'Users'=>['login'=>true, 'register'=>true]
			]
		];
		
		if(empty( $isAuth[$type][$controller][$action] )){
			return $this->redirect(['controller'=>'Users', 'action' => 'login']);
		}
    }
}
