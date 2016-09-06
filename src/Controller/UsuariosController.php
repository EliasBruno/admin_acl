<?php

namespace Admin\Controller;

use Cake\Network\Exception\ForbiddenException;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Network\Email\Email;

/**
 * Classe Usuarios
 */
class UsuariosController extends AppController {

	protected $grupo;
	protected $projeto;
	protected $empresa;

	/**
	 * Initialization hook method.
	 *
	 * Use this method to add common initialization code like loading components.
	 *
	 * @return void
	 */
	public function initialize() {
		parent::initialize();
		$this->model = TableRegistry::get("Admin.Usuarios");
		$this->projeto = TableRegistry::get("Projetos.Projetos");
		$this->empresa = TableRegistry::get("Empresas.Empresas");

    	$this->Auth->allow();
	}

	public function beforeFilter(Event $event) {
	    parent::beforeFilter($event);
	    // Allow users to register and logout.
	    // You should not add the "login" action to allow list. Doing so would
	    // cause problems with normal functioning of AuthComponent.
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
		$usuarios=[];
		$usuarios=$this->model->find("all")->contain(["Projetos"]);
		$this->paginar($usuarios);
	}

	/**
	* Cadastrar Usuarios
	*
	* Metodo para cadastrar Registro na tabela
	*
	* @return void
	*/
	public function cadastrar(){
		$this->set("title_form","Cadastrar Usuários");
		$this->set("projetos",$this->projeto->find('list'));
		$usuarios = $this->model->newEntity($this->request->data);
		$this->set("empresas",$this->empresa->find('list'));
      	if ($this->request->is('post')) {
	        	$usuarios->senha = rand(1,20).str_shuffle("abc@#$%").date("Ymd");

	        	$email = new Email('default');
		        $email->viewVars(["cpf"=>$usuarios->cpf,"senha"=>$usuarios->senha]);
		        $email
		            ->template('nova_senha', 'default')
		            ->emailFormat('html')
								->subject('Planeto Informa: Acesso ao Sistema!')
		            ->to($this->request->data["email"]);

	            if ($this->model->save($usuarios)) {
	            	$email->send();
	                $this->Flash->success(__('Usuário Cadastrado e enviado um email com login e senha'));
	                return $this->redirect(['action' => 'index']);
	            }
	            $this->Flash->error(__('.'));

        }
        $this->set('usuarios', $usuarios);
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
		$this->set("title_form","Editar Usuários");
		$this->set("projetos",$this->projeto->find('list'));

	    $usuarios = $this->model->get($id);
	    $this->set("empresas",$this->empresa->find('list')->where(["projeto_id"=>$usuarios->projeto_id]));

	    unset($usuarios->senha);
	    if ($this->request->is(['post', 'put'])) {
	    	$data = $this->request->data;
	        if(empty($data["senha"]))
	        	unset($data["senha"]);

	        $this->model->patchEntity($usuarios, $data);
	        if(empty($this->request->data["senha"]) && empty($this->request->data["confirme_senha"])){
	        	if ($this->model->save($usuarios)) {
	    	            $this->Flash->success(__('Usuário atualizado com sucesso.'));
	    	            return $this->redirect(['action' => 'index']);
	    	        }
    	        $this->Flash->error(__('Erro ao autalizar Usuário.'));
	        }else{
		        if($this->confirme_senha($this->request->data["senha"],$this->request->data["confirme_senha"])){
	    	        if ($this->model->save($usuarios)) {
	    	            $this->Flash->success(__('Usuário atualizado com sucesso.'));
	    	            return $this->redirect(['action' => 'index']);
	    	        }
	    	        $this->Flash->error(__('Erro ao autalizar Usuário.'));
	    	    }else{
	    	    	$this->Flash->error(__('Senhas não conferem.'));
	    	    }
	    	}
	    }

	    $this->set('usuarios', $usuarios);
	    $this->render("form");
	}

	/**
	* Atualizar Área
	*
	* Metodo para atualizar Registro na tabela, recebe como parâmetro o id do registro
	*
	* @return void
	*/
	public function perfil($id = null) {
	    if (!is_numeric($id)) {
	        throw new NotFoundException(__('ID deve ser um número'));
	    }
		$this->set("title_form","Editar Usuários");
		$this->set("projetos",$this->projeto->find('list'));

	    $usuarios = $this->model->get($id);
	    unset($usuarios->senha);
	    if ($this->request->is(['post', 'put'])) {
	    	$data = $this->request->data;
	        if($data["senha"]=="")
	        	unset($data["senha"]);

	        $this->model->patchEntity($usuarios, $data);

	        if($this->confirme_senha($this->request->data["senha"],$this->request->data["confirme_senha"])){
    	        if ($this->model->save($usuarios)) {
    	            $this->Flash->success(__('Perfil atualizado.'));
    	            return $this->redirect(["controller"=>"painel",'action' => 'index']);
    	        }
    	        $this->Flash->error(__('Erro ao autalizar Área.'));
    	    }else{
    	    	$this->Flash->error(__('Senhas não conferem.'));
    	    }
	    }

	    $this->set('usuarios', $usuarios);
	}

	public function confirme_senha($senha,$confirme_senha){
		if($senha===$confirme_senha)
			return true;
		else
			return false;
	}

	public function pdf(){
	   $this->autoRender=false;
       $this->layout= "pdf";

	   $usuarios=$this->model->find("all")->contain(["Projetos"]);
	   $this->set(compact("usuarios"));

	   $response = $this->render('pdf');
       $thebody = $response->body();
       $this->Mpdf->pdf($thebody);
	}

}
