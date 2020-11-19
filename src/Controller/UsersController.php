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
			$query = $this->Users->find()->where( ['email =' => $form['email'] ])->first();
			if(!empty($query)){
				if(( new DefaultPasswordHasher() )->check($form['password'], $query->password)){
					//good email / password 
					$this->authUser->write('type', $query->type);
					return $this->redirect(['action' => 'index']);
				}else{
					//bad password
					echo 'BAD PASS';
				}
			}else{
				//no results
				echo 'NO USER';
			}
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
			$user->email = $randomString.'gmail.com';
			$user->email_key = $emailKey;
			$user->type = 1;
			$user->date = date('Y-m-d');
			
			//information saved
			if ($userTbl->save($user)) { $id = $user->id; }				
			
			//url for the activation email
			$url = Router::url( ['controller' => 'Users', 'action' => 'activate', $emailKey] , true);
			
			//send email with activation key
			$email = new MailgunMailer();
			$email->setFrom(['dev@bluejaydev.com' => 'K_app Bot'])
				->setEmailFormat('html')
				->setTo(['justinpaulheintz@gmail.com' ])
				->setSubject('New account registered')
				->setViewVars(['url' => $url ])
				->viewBuilder()->setTemplate('activate');
			$email->deliver();
		}
		$this->viewBuilder()->setLayout('front-end');
	}
	public function activate($key = null){
		$user = $this->Users->find()->where(['email_key =' => $key ,'active ='=>0])->first();
		
		if(!empty($user)){
			$this->Users->patchEntity($user, ['active'=>1] );
            if ($this->Users->save($user)) {
				$success = true;
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