<?=$this->Form->create($usuarios); ?>
<div class="box-body">
	<div class="row">
        <div class="col-xs-4" >	
			<?=$this->Form->input("nome",["class"=>"form-control"]);?>
		</div>
	</div>
	<div class="row">		

		<div class="col-xs-2" >		
			<?=$this->Form->input("telefone",["data-mask"=>"phone","class"=>"form-control"]);?>
		</div>
	</div>
	<div class="row">		
		<div class="col-xs-4" >		
			<?=$this->Form->input("email",["type"=>"email","class"=>"form-control"]);?>
		</div>
	</div>	
	
	<?php $required; ($usuarios->id)?$required=false:$required=true;?>
	<div class="row">		
		<div class="col-xs-3" >		
			<?=$this->Form->input("senha",["label"=>"Nova Senha","type"=>"password","required"=>$required,"class"=>"form-control"]);?>
		</div>
		<div class="col-xs-3" >		
			<?=$this->Form->input("confirme_senha",["type"=>"password","class"=>"form-control"]);?>
		</div>
	</div>	
	<div class="row">		
			
			<?=$this->Form->button(__('Salvar'),['class'=>'btn btn btn-lg']);?>
	</div>
<?=$this->Form->end(); ?>