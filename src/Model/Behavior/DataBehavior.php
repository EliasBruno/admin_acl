<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;

class DataBehavior extends Behavior {
     protected $_defaultConfig = [
        'field' => 'title',
        'slug' => 'slug',
        'replacement' => '-',
    ];

    public function slug(Entity $entity) {
        $config = $this->config();
        $value = $entity->get($config['field']);
        $entity->set($config['slug'], Inflector::slug($value, $config['replacement']));
    }

    public function beforeSave(Event $event, Entity $entity) {
        var_dump($entity->data);
    }
}
