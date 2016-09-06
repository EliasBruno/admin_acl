<?php

namespace Admin\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class GruposTable extends Table{
	
	public function initialize(array $config)
	{
		$this->table("grupos");
        $this->displayField('nome');
        $this->hasMany("Usuarios");
        $this->addBehavior('Acl.Acl', ['type' => 'requester']);
	}

	public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('nome',"Campo de preenchimento obrigatório!");
			
			return $validator;
    }

}