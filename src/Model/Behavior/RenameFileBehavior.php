<?php
namespace App\Model\Behavior;

use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;

class RenameFileBehavior extends Behavior
{
    protected $_defaultConfig = [
        'field_dir' => 'arquivo_dir',
        'dir' => 'dir',
    ];

    public function afterSave(Event $event, Entity $entity, $options) {
       $eventName = $event->name();
       $config = $this->config()['events'];
       if('Model.afterSave'==$eventName){
         foreach($config[$eventName] as $field=>$fields){
           $field = $entity->get($field);
           if(is_string($field)){
             $field_dir = $entity->get($fields['field_dir']);
             if($field!="")
                $this->rename($field,$field_dir,$fields['dir'],$entity->id);
           }
         }
       }

    }

    protected function rename($field,$field_dir,$dir,$new_name){
      $ext= $this->extension($field);
      $DIR = WWW_ROOT.$dir;
      if(file_exists($DIR.$field_dir."/".$field))
          rename($DIR.$field_dir."/".$field, $DIR.$field_dir."/".$new_name.".".$ext);
      else
          throw new \UnexpectedValueException(
              sprintf('Not found "%s" directory', $DIR)
          );
    }

    protected function extension($name){
      return pathinfo($name,  PATHINFO_EXTENSION);
    }
}
