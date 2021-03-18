<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TaskGroupsTable extends Table{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('task_groups');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
		
		$this->hasMany('Tasks', [ 'className' => 'Tasks' ,'foreignKey' => 'gid']);
		
    }
    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        return $rules;
    }
}
