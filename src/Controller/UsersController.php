<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Routing\Router;
use Authentication\PasswordHasher\DefaultPasswordHasher; 

use Cake\Mailer\Mailer;
use Mailgun\Mailer\MailgunTransport;
use Mailgun\Mailer\MailgunMailer;

class UsersController extends AppController{
    public function login(){
		if ($this->request->is('post')) {
			$form = $this->request->getData();
			$query = $this->Users->find()->where( ['email =' => $form['email'], 'active =' => 1 ])->first();
			//debug($query);
			if(!empty($query)){
				if(( new DefaultPasswordHasher() )->check($form['password'], $query->password)){
					//TODO: CHANGE THIS TO REDIRECT SOMEWHERE ELSE
					//good email / password 
					$this->authUser->write('User.id', $query->id);
					$this->authUser->write('User.first_name', $query->first_name);
					$this->authUser->write('User.last_name', $query->last_name);
					$this->authUser->write('type', 0);
					return $this->redirect(['controller' => 'tasks', 'action' => 'create']);
				}else{
					//bad password
					$this->set('errorMsg','NO USER OR BAD PASSWORD');
				}
			}else{
				//no results
				$this->set('errorMsg','NO USER OR ACCOUNT IN NOT ACTIVE');
			}
		}
		
		//lets the user know if they have to activate their account.
		if( $this->authUser->read('User.setReg') ){
			$this->authUser->write('User.setReg', false);
			$this->set('activate', true);
		}
		
		 $this->viewBuilder()->setLayout('front-end');
    }
    public function index(){
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }
	public function logout(){
		$this->authUser->destroy();
		return $this->redirect(['action' => 'login']);
	}
    public function view($id = null){
        $user = $this->Users->get($id, ['contain' => [],]);
        $this->set(compact('user'));
    }
    public function add(){
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			
			$user->date = date('m/d/y');

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
               return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }
    public function edit($id = null){
        $user = $this->Users->get($id, ['contain' => [],]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }
    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	public function register(){
		if ($this->request->is('post')) {
        
			//basic validation
			$secret = '6LenXwwTAAAAAAZy3k0Ita-k2uw7R19E6elOSJ46';
			$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
			$responseData = json_decode($verifyResponse);

			$user = $this->Users->find()->where(['email =' => $_POST['email'] ])->first();

			if(!empty($user)){
				echo   'email exists';
				die();
			}
			if(empty($_POST['fname'] ) || empty($_POST['lname'] ) || empty($_POST['gender'] ) || empty($_POST['email'] ) || empty($_POST['pass']) || empty($_POST['cpass'])  ){
				echo   'fields empty';
				die();		
			}
			if( $_POST['pass']  !=  $_POST['cpass'] ){
				echo   'password match failed';
				die();
			}
			if(!$responseData->success){
				echo   'Robot verification failed, please try again.';
				die();
			}
			
			$userTbl = $this->getTableLocator()->get('Users');
			$user = $userTbl->newEmptyEntity();			
			
			//dev junk to generate emails
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < 10; $i++) { $randomString .= $characters[rand(0, $charactersLength - 1)]; }		
			
			//generate key for emails so users can activate their  account
			$emailKey = $this->_gen_email_key(40);
			
			//set values for userEntity;			
			$user->first_name = $_POST['fname'] ;
			$user->last_name = $_POST['lname'] ;
			$user->gender = $_POST['gender'] ;
			$user->email = $_POST['email'];
			$user->email_key = $emailKey;
			$user->password = $_POST['pass'] ;
			$user->creation_date = date('Y-m-d');
			
			//information saved
			if ($userTbl->save($user)) { $id = $user->id; }				
			
			//url for the activation email
			$url = Router::url( ['controller' => 'Users', 'action' => 'activate', $emailKey] , true);
			
			//send email with activation key
			$email = new MailgunMailer();
			$email->setFrom(['dev@bluejaydev.com' => 'K_app Bot'])
				->setEmailFormat('html')
				->setTo(['justinpaulheintz@gmail.com',$_POST['email'] ])
				->setSubject('New account registered')
				->setViewVars(['url' => $url ])
				->viewBuilder()->setTemplate('activate');
			$email->deliver();
			
			$this->authUser->write('User.setReg', true);

			return $this->redirect(['action' => 'login']);
		}

		$this->viewBuilder()->setLayout('front-end');
	}
	public function activate($key = null){
		$user = $this->Users->find()->where(['email_key =' => $key ,'active ='=>0])->first();
		
		if(!empty($user)){
			$this->Users->patchEntity($user, ['active'=>1] );
            if ($this->Users->save($user)) {
				$success = true;
				$this->authUser->write('User.setReg', false);
				return $this->redirect(['controller' => 'tasks', 'action' => 'create']);
			}
		}else{
			$success = false;
		}
		
		$this->set('success', $success);
	}
	private function _gen_email_key($length){
		return bin2hex(random_bytes($length));
	}	
}