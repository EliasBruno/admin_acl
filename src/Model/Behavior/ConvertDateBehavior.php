<?php
namespace App\Model\Behavior;

use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;

class ConvertDateBehavior extends Behavior
{
    protected $_defaultConfig = [
        'date' => 'date',
    ];

    public function beforeSave(Event $event, Entity $entity, $options) {
       $eventName = $event->name();
       $config = $this->config()['events'];
       if('Model.beforeSave'==$eventName){
         foreach($config[$eventName] as $field){
           $value = $entity->get($field);
           if(self::checked($value)){
             $entity->$field= $this->convertToUS($value);
           }
         }
       }

    }
    /**
     * @param string $date recebe uma data
     *
     * @return void
     */
    private function checked($date)
    {
      return preg_match( "'^\d{1,2}/\d{1,2}/\d{4}$'" , $date );
    }

    /**
      * Converter data para o formato americano
      *
      * @param string $date recebe uma data
      *
      * @return void
      */
      private function convertToUS($data)
      {
          $nova_data = implode("-",array_reverse(explode("/",$data)));
          return $nova_data;
      }
}
