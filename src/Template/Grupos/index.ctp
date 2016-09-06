
<?php echo $this->element("abas");?>
<div class="container content">
  <div class="container">
  <?=$this->Form->create("Procedimentos",["type"=>"GET","class"=>"proj-pesquisar"]); ?>
    <fieldset>
    <div class="form-group form-group-sm">
      <div class="col-sm-4">
          <?=$this->Form->input("listprocedimento_id",["label"=>"Procedimentos", "empty"=>"Selecione", "class"=>"form-control","label">false]);?>
      </div>
        <button type="submit" class="btn btn-sm btn-primary proj-inline-form-bt">Pesquisar</button>
    </div>
    </fieldset>
  <?=$this->Form->end(); ?>
</div> <!-- /form -->
 <?php echo $this->element("paginacao");?>
 <div class="container">
    <table class="table proj-table table-condensed table-bordered table-hover">
	    <tr >
            <th>Nome</th>
			<th colspan="2">Ações</th>
		</tr>
		<?php foreach($dados as $grupo):?>
		<tr>	
			<td><?=$grupo->nome;?></td>
			<td><?=$this->Html->link("Editar",["controller"=>"grupos","action"=>"editar",$grupo->id]);?></td>
			<td><?= $this->Form->postLink('Excluir',['action' => 'delete', $grupo->id],['confirm' => 'Deletar '.$grupo->id." ?"]);?></td>
		</tr>
		<?php endforeach; ?>
	</table>
 </div>	
</div>	 