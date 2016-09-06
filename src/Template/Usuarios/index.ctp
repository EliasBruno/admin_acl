<table class="table table-bordered table-hover dataTable">
	<thead>
	    <tr class="btn-primary">
			<th>Nome</th>
			<th>CPF</th>
	        <th>Projeto</th>
			<th colspan="2">Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($dados as $usuario):?>
		<tr>
			<td><?=$usuario->nome;?></td>
			<td><?=$usuario->cpf;?></td>
	        <td><?php if($usuario->projeto) echo $usuario->projeto->nome;?></td>
			<td><?=$this->Html->link("Editar",["prefix"=>"admin","controller"=>"usuarios","action"=>"editar",$usuario->id]);?></td>
			<td><?= $this->Form->postLink('Excluir',["prefix"=>"admin",'action' => 'delete', $usuario->id],['confirm' => 'Deletar '.$usuario->id." ?"]);?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?=$this->element("pagination"); ?>
