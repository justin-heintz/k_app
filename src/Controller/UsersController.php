<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;
use Authentication\PasswordHasher\DefaultPasswordHasher; 
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
    }
    public function index(){
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
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
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
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
			$email = new MailgunMailer();
			$email->setFrom(['dev@bluejaydev.com' => 'CakePHP Mailgun'])
			->setTo('justinpaulheintz@gmail.com')
			->setSubject('What a blast')
			->deliver('What a blast');		
		}
	}
}