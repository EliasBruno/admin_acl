<?=$this->Form->create($usuarios); ?>
<div class="box-body">
	<div class="row">
        <div class="col-xs-4" >
			<?=$this->Form->input("nome",["class"=>"form-control"]);?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-2" >
			<?=$this->Form->input("cpf",["data-mask"=>"login","class"=>"form-control"]);?>
		</div>
		<div class="col-xs-2" >
			<?=$this->Form->input("telefone",["data-mask"=>"phone","class"=>"form-control"]);?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-4" >
			<?=$this->Form->input("email",["type"=>"email","class"=>"form-control"]);?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-2" >
			<?= $this->Form->input('grupo',["empty"=>"Selecione","class"=>"form-control","options"=>["admin"=>"Admin","gerenciadora"=>"Gerenciadora","contratada"=>"Contratada"]]); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-4" >
			<?=$this->Form->input("projeto_id",["empty"=>"Selecione","class"=>"form-control dropdown","data-url"=>"/admin/empresas/dropdown"]);?>
		</div>
		<div id="div-select" class="col-xs-4" >
			<?=$this->Form->input("empresa_id",["empty"=>"Selecione","class"=>"form-control"]);?>
		</div>
	</div>
	<div class="row">
			<?=$this->element("checkbox",["name"=>"notificacao","value"=>1,'checked'=>$usuarios->notificacao,
			"label"=>"Receber Notificações por Email?"]); ?>
	</div>
	<div class="row">

			<?=$this->Form->button(__('Salvar'),['class'=>'btn btn btn-lg']);?>
	</div>
<?=$this->Form->end(); ?>
