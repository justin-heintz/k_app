<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TaskTypesTable extends Table{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('task_types');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
