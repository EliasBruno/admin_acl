<?php
// src/Model/Entity/User.php
namespace Admin\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class Usuario extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

    // ...

    protected function _setSenha($senha) {
        return (new DefaultPasswordHasher)->hash($senha);
    }

    public function parentNode()
	{
	    if (!$this->id) {
	        return null;
	    }
	    if (isset($this->grupo_id)) {
	        $grupoId = $this->grupo_id;
	    } else {
	        $Users = TableRegistry::get('Usuarios');
	        $user = $Users->find('all', ['fields' => ['grupo_id']])->where(['id' => $this->id])->first();
	        $grupoId = $user->grupo_id;
	    }
	    if (!$grupoId) {
	        return null;
	    }
	    return ['Grupos' => ['id' => $grupoId]];
	}
}