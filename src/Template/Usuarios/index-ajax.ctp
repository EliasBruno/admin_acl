<div id="divSerialize">
    <?=$this->Form->create("Pessoas",["id"=>"formSerialize"]); ?>
     <div class="row">
         <div class="col-xs-4">
            <?=$this->Form->input("nome",["class"=>"form-control"]);?> 
         </div>
         <div class="col-xs-4">  <br/> 
            <label></label>
            <?=$this->Form->button(__('Pesquisar'),["class"=>"btn btn-primary btn-lg","id"=>"buttonSerialize"]);?>
         </div>   
    </div>      
    <?=$this->Form->end(); ?>
<table id="table-ajax" class="table table-bordered table-hover dataTable">
   <thead class="btn-primary">
        <tr>
            <th>Nome</th>
            <th >Ações</th>
	</tr>
   </thead>
   <tbody>
	<?php foreach($dados as $pessoa):?>
	<tr id="<?='tr_'.$pessoa->id;?>">
            <?=$this->Form->input("Treinandos.".$pessoa->id.".nome_id",["type"=>"hidden","value"=>$pessoa->id]);?>
            <td><?=$pessoa->nome;?></td>
            <td id="<?='td_'.$pessoa->id;?>"><a href="#" class="btn btn-success btn-lg html_appendTo" send="<?=$pessoa->id;?>" request="#showTreinandos" role="button">Adicionar »</a></td>
        </tr>
	<?php endforeach; ?>
   </tbody>     
</table>
<?php  echo $this->element("pagination");?>
</div>