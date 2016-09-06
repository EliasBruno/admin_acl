<?php
// src/Model/Entity/User.php
namespace Admin\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

class Grupo extends Entity {

    // Make all fields mass assignable for now.
    protected $_accessible = ['*' => true];

  
    public function parentNode()
	{
	    return null;
	}
}