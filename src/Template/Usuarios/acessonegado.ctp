<style type="text/css">
    .center {text-align: center; margin-left: auto; margin-right: auto; margin-bottom: auto; margin-top: auto;}

</style>
<div class="container">
  <div class="row">
    <div class="span12">
      <div class="hero-unit center">
          <img src="/img/bloqueio.png" width="220" height="220"></img>
          <h1><span style="color:#FFFFFF">Acesso Negado</span> </h1>
          <br />
          <p><h3><span style="color:#FFFFFF"><?php echo "Você não tem as devidas permissões para acessar a área requisitada!";?></span><h3></p>
          <?php if($this->Session->read("Auth")["User"]["grupo"]=="contratada") { ?>
            <a href="/contratada/painel" class="btn btn-lg btn-info"><i class="icon-home icon-white"></i> Tela Inicial</a>
          <?php }else{?>
            <a href="/admin/painel" class="btn btn-lg btn-info"><i class="icon-home icon-white"></i> Tela Inicial</a>
          <?php }?>

        </div>
     
    </div>
  </div>
</div>