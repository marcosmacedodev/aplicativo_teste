<?php

if (!$this->session->userdata('logged_in')) redirect(site_url('login')); ?>
<div class="container mt-5">

    <form method="post" action="<?php echo site_url('login/alterar_senha'); ?>">
    <div class="row justify-content-md-center">
        <div class="col-6">
            <?php echo validation_errors(); ?>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-3">
            <label for="" class="form-label">Usu&aacute;rio</label>
            <input type="text"  class="form-control" value="<?php echo $this->session->userdata('usuario'); ?>" disabled />
        </div>
    </div>    
    <div class="row justify-content-md-center">
        <div class="col-3">
            <label for="senha" class="form-label">Senha atual</label>
            <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" />
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-3">
            <label for="nova_senha" class="form-label">Nova Senha</label>
            <input type="password" name="nova_senha1" class="form-control" placeholder="Digite uma nova senha" value="" />
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-3">
            <label for="nova_senha" class="form-label">Confirmar nova senha</label>
            <input type="password" name="nova_senha2" class="form-control" placeholder="Confirme a nova senha" value="" />
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-3 mt-3">
            <input type="submit" value="Confirmar"  class="btn btn-primary"/> 
        </div>
    </div>
</form>
</div>