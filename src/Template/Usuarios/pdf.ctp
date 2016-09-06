<html>
<head></head>

    <body>
        <div class="title" width="100%" style="background: #eee; font-size: 30px;">
          Usuários Cadastrados no Planeto
          <!--<small align="right">Date: 2/10/2014</small>-->
        </div>            
             <hr/>
	  	<table class="table sample" width="100%" >
				<thead >
				    <tr class="btn-info">
						<th>Nome</th>
						<th>CPF</th>
				        <th>Email</th>
				        <th>Telefones</th>
				        <th>Projeto</th>
					</tr>
				</thead>
				<tbody>	
					<?php foreach($usuarios as $usuario):?>
					<tr>	
						<td><?=$usuario->nome;?></td>
						<td><?=$usuario->cpf;?></td>
						<td><?=$usuario->email;?></td>
						<td><?=$usuario->telefone."/".$usuario->celular;?></td>
				        <td><?php if($usuario->projeto) echo $usuario->projeto->nome;?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>	
			</table>
			 <hr/><br/>                    
    </body>
</html>
                   