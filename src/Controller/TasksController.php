<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Routing\Router;

use Cake\Mailer\Mailer;
use Mailgun\Mailer\MailgunTransport;
use Mailgun\Mailer\MailgunMailer;

use Cake\ORM\TableRegistry;

class TasksController extends AppController{
	
	var $uses = array('TaskGroups');	

	public function view(){
		$this->loadModel('TaskGroups');
		$this->loadModel('TaskTypes');
		
		$types = $this->TaskTypes->find('all');
		$groups = $this->TaskGroups->find()->where( ['uid =' => $this->authUser->read('User.id') ])->contain(['Tasks'=>['TaskTypes'] ]);

		$this->set(['groups'=>$groups, 'types'=>$types]);
		$this->viewBuilder()->setLayout('back-end');		
	}
	public function create(){
		$this->loadModel('TaskGroups');
		$this->loadModel('TaskTypes');
		
		if ($this->request->is('post')) {
			$target_file =  'user_assets/'.basename($_FILES["g_image"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
			
			$check = getimagesize($_FILES["g_image"]["tmp_name"]);
			if($check !== false) {
				  if (move_uploaded_file($_FILES["g_image"]["tmp_name"], $target_file)) {
				  } else {
					echo "Sorry, there was an error uploading your file.";
				  }
			} else {
				echo "File is not an image.";
				exit();
			}
			//insert the task group
			$tgTable = TableRegistry::getTableLocator()->get('TaskGroups');
			$group = $tgTable->newEmptyEntity();
			 
			$group->uid = $this->authUser->read('User.id');
			$group->title = $_POST['g_title'];
			$group->description = $_POST['g_description'];
			$group->img = $target_file;
			$group->status = 'pending';
			$group->creation_date = date('Y-m-d');
			
			$tgTable->save($group);
			//insert the tasks
			for($i=0; $i < count( $_POST['t_title'] ) ; $i++){
				$taskTable = TableRegistry::getTableLocator()->get('Tasks');
				$task = $taskTable->newEmptyEntity();
				
				$task->gid = $group->id;
				$task->uid = $this->authUser->read('User.id');
				$task->tyid = $_POST['t_type'][$i];
				$task->max_users = $_POST['t_max_users'][$i];
				$task->title = $_POST['t_title'][$i];
				$task->credit = $_POST['t_credit'][$i];
				
				$taskTable->save($task);
			}
			exit();
		}
		
		$types = $this->TaskTypes->find('all');
		$this->set([ 'types'=>$types]);
		$this->viewBuilder()->setLayout('back-end');		
	}
}