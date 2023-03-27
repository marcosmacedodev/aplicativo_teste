<?php

if (!$this->session->userdata('logged_in')) redirect(site_url('login')); ?>

<div class="container mt-5">
<?php if ($this->session->userdata('tipo') == 2) {?>
<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('colaboradores/create'); ?>
    <div class="row">
        <div class="col-3">
            <label class="form-label" for="usuario">Usuário (Acesso)</label>
            <input type="text" class="form-control" name="usuario"/>
        </div>
        <div class="col-3">
            <label class="form-label" for="senha">Senha (Acesso)</label>
            <input type="password" class="form-control" name="senha" />
        </div>
        <div class="col-6">
            <label class="form-label" for="email">E-mail</label>
            <input type="text" class="form-control" name="email" />
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <label class="form-label" for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" />
        </div>
        <div class="col-3">
            <label class="form-label" for="sobrenome">Sobrenome</label>
            <input type="text" class="form-control" name="sobrenome" />
        </div>
        <div class="col-3">
            <label class="form-label" for="status">Status</label>
            <select name="status" class="form-control">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
                <option value="2">Bloqueado</option>
                <option value="" selected>Selecione uma op&ccedil;&atilde;o</option>
            </select>    
        </div>
        <div class="col-3">
            <label class="form-label" for="tipo">Tipo</label>
            <select name="tipo" class="form-control">
                <option value="2">Administrador</option>
                <!-- <option value="1">Fornecedor</option> -->
                <option value="0" selected>Normal</option>
                <option value="" selected>Selecione uma op&ccedil;&atilde;o</option>
            </select>    
        </div>
        <div class="col-12 mt-5">
            <input class="btn btn-primary" type="submit" name="submit" value="Criar" />
        </div>
    </div>
</form>
<?php } else {?>
    <div class="alert alert-warning" role="alert">
        Voc&ecirc; n&atilde;o tem permiss&atilde;o para esta &aacute;rea.
    </div>
<?php }?>
</div>