<?php

namespace Admin\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;
use Cake\ORM\Entity;

class UsuariosTable extends Table{

	public function initialize(array $config)
	{
		$this->table("usuarios");
    	$this->displayField('nome');
		$this->addBehavior('Log.Logs');
		$this->belongsTo("Projetos");
        $this->addBehavior('Acl.Acl', ['type' => 'requester']);    
	}

	public function beforeSave(Event $event, Entity $entity) {
        //var_dump($event);
    if($entity->senha!="")
		  $entity->senha =(new DefaultPasswordHasher)->hash($entity->senha);
		return true;
  }

	public function validationDefault(Validator $validator) {
        $validator
            ->notEmpty('nome',"Campo de preenchimento obrigatório!")
						->notEmpty('cpf',"Campo de preenchimento obrigatório!")
						->notEmpty('email',"Campo de preenchimento obrigatório!")
            ->add('cpf', [
                'unique' => ['rule' => 'validateUnique',
                             'provider' => 'table',
                             'message' => 'CPF já cadastrado!']
            ])
            //->notEmpty('senha',"Campo de preenchimento obrigatório!","create")
            ->notEmpty('grupo', "Campo de preenchimento obrigatório!")
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'gerenciadora','contratada']],
                'message' => 'Please enter a valid role'
            ]);

			return $validator;
    }

}
