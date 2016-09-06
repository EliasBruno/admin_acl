<?php

namespace Admin\Controller;

use Cake\Network\Exception\ForbiddenException;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * Classe Grupos
 */
class GruposController extends AppController {

	protected $grupo;
	protected $projeto;
	protected $empresa;
	protected $aco;
	
	/**
	 * Initialization hook method.
	 *
	 * Use this method to add common initialization code like loading components.
	 *
	 * @return void
	 */
	public function initialize() {
		parent::initialize();
		$this->set("title_layout","Usuários");
		$this->model=$this->Grupos;
		$this->projeto = TableRegistry::get("Projetos.Projetos");
		$this->empresa = TableRegistry::get("Empresas.Empresas");
		$this->aco = TableRegistry::get("Acl.Acos");
		$this->aro = TableRegistry::get("Acl.Aros");
		$this->permission = TableRegistry::get("Acl.Permissions");
   		$this->Auth->allow();
	}


	/**
	* Pesquisar Usuarios
	*
	* Metodo para pesquisar Registros na tabela
	*
	* @return void
	*/
	public function index(){

		$this->set("title_form","Pesquisar Usuários");
		$grupos=[];
		$grupos=$this->model->find("all");
		$this->paginar($grupos);
	}

	/**
	* Cadastrar Usuarios
	*
	* Metodo para cadastrar Registro na tabela
	*
	* @return void
	*/
	public function cadastrar(){

		$entity = $this->model->newEntity($this->request->data);
      	if ($this->request->is('post')) {

            if ($this->model->save($entity)) {
                $this->Flash->success(__('Usuário Cadastrado e enviado um email com login e senha'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('.'));

        }
        $this->set('entity', $entity);
		$this->render("form");
	}

	/**
	* Atualizar Área
	*
	* Metodo para atualizar Registro na tabela, recebe como parâmetro o id do registro
	*
	* @return void
	*/
	public function editar($id = null) {
    if (!is_numeric($id)) {
	        throw new NotFoundException(__('ID deve ser um número'));
	    }

	    $entity = $this->model->get($id);
	    $acos_pais = $this->aco->find('all')->where(['parent_id'=>1])->toArray();
	    $dados=[];
	    foreach ($acos_pais as $modulo) {
	    	$modulos =$this->aco->find('children', ['for' => $modulo['id']])->find('threaded')->toArray();

	    	foreach ($modulos as $key => $controller) {
	    		$controllers = $this->aco->find('all')->where(['parent_id'=>$controller['id']])->toArray();
	  	    	foreach ($controllers as $key => $action) {
	  				$dados[$modulo['alias']][$controller['alias']][]=['acao'=>$action->alias,'id'=>$action->id];
	  			}	
	    	}
	    }
	    
    	$permissoes = $this->permission->find('list', ['valueField' => 'aco_id'])
    	->where(['aro_id'=>$entity->id])->toArray();
    	

	    if ($this->request->is(['post', 'put'])) {
	    	$data = $this->request->data;
	        $this->model->patchEntity($entity,$data );
	        if ($this->model->save($entity)) {
	        	//Buscando Grupo na tabela Aro
	        	$aro = $this->aro->find('all')->where(['foreign_key'=>$entity->id])->first();
	        	//Salvando Permissões
	        	$this->permission->deleteAll(['aro_id' => $entity->id]);	
	        	foreach ($data as $key => $val) {
	        		if(isset($val['action'])){
		    			$permission = $this->permission->newEntity(['aro_id'=>$aro->id,'aco_id'=>$val['action']]);
			         	$this->permission->save($permission);
		         	}
		    	}
	        	
	            $this->Flash->success(__('Grupo atualizado com sucesso.'));
	            return $this->redirect(['action' => 'index']);
	        }
	        $this->Flash->error(__('Erro ao autalizar Grupo.'));
	    }

	    $this->set(compact('entity','dados','permissoes'));
	    $this->render("form");
	}
}
