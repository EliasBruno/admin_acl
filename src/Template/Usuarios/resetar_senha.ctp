
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6  col-sm-8 col-sm-offset-3">     
    	               
        <div id="panel" class="panel panel-info" >
	        <div class="panel-heading">
	            <?= $this->Flash->render() ?>	
	            <div class="panel-title">Insira Seu Email para o Envio da Nova Senha</div>                        
	        </div>     
	        <div style="padding-top:30px" class="panel-body" >
	                        
	            <?=$this->Form->create(); ?>
	                   </br>       
	                <div style="margin-bottom: 25px" class="col-xs-6 input-group">

	                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<?=$this->Form->input("email",["required"=>true,"type"=>"email","class"=>"form-control","label"=>false]);?>
	                </div>
	                <div class="row">		
						<div class="col-xs-4" >   
			                <div style="margin-bottom:25px" class="col-xs-6 input-group">
			                     <?=$this->Form->button(__('Gerar Nova Senha'),['class'=>'btn btn-primary btn-large']);?>
				            </div>
				        </div>
				        <div class="col-xs-2" >
				        	<a class='btn btn-primary btn-large' href="/usuarios/login"><i class="fa fa-arrow-circle-left"></i> Voltar para Login</a>
				    	</div>
				    </div>          
	            <?=$this->Form->end(); ?>
            </div>                     
        </div>  
        
    </div>
  