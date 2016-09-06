<?=$this->element("DDS.abas/dds");?>
<div class="container content">

  <?=$this->Form->create($entity); ?>

    <fieldset>
      <legend>
        Grupo
      </legend>

			<div class="row">
		        <div class="col-xs-6" >	
					<?=$this->Form->input("nome",["class"=>"form-control"]);?>
				</div>
			</div>			
    </fieldset>
    <?php if (!empty($dados)): ?>
    	
	<fieldset>
      <legend>
        Permissões
      </legend>		
			<?php $check='';foreach ($dados as $key => $modulo): ?>
 
				<fieldset>
			      <legend class="btn-info"><?=$key?></legend>

					<?php foreach ($modulo as $key => $controller): ?>
						
	  					<table class="table proj-table table-condensed table-bordered table-hover">
	  						<thead>
								<tr>
									<th width="20%"><?=$key?></th>
									<th>
										<?=$this->element("checkbox",['class'=>'checar-todos',"name"=>'checkall',"value"=>1,'id'=>"$key",'checked'=>false,"label"=>""]); ?>
									</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($controller as $action): ?>
							<tr>
								<td><?=$action['acao'];?></td>
								<td>
									<?php $check = (in_array($action['id'], $permissoes))? true:false;?>
									<?=$this->element("checkbox",['class'=>'acoes'.$key,"name"=>$action['id'].".action","value"=>$action['id'],'checked'=>$check,"label"=>""]); ?>
								</td>
							</tr>
							<?php endforeach ?>
							</tbody>
						</table>
					<?php endforeach ?>
				</fieldset>
			<?php endforeach ?>	
	</fieldset>	
    <?php endif; ?>
	<fieldset class="botoes borda">
      <div class="form-group form-group-sm">
        <div class="col-sm-2 col-md-offset-10">
          <button type="submit" class="btn btn-primary proj-btn-pull-right">
            Salvar <i aria-hidden="true"></i>
          </button>

        </div>
      </div>
  <?=$this->Form->end(); ?>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(".checar-todos").on('ifChanged',function(){
			var id = $(this).attr('id');
	        if($(this).is(':checked')) {
       			$(".acoes"+id).iCheck('check');
	        } else {
	         $(".acoes"+id).iCheck('uncheck');
	        }
	    });
	});
</script>