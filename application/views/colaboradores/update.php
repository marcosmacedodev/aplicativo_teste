<?php 
if (!$this->session->userdata('logged_in')) redirect(site_url('login'));

?>
<div class="container mt-5">
<?php if ($this->session->userdata('tipo') == 2) {?>

<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('colaboradores/update/' . $colaboradores['colaborador_ID']); ?>
<div class="row">
        <div class="col-3">
            <label class="form-label" for="">Usuário (Acesso)</label>
            <input type="text" class="form-control" disabled placeholder="<?php echo $colaboradores['usuario'] ?>"/>
        </div>
        <div class="col-3">
            <label class="form-label" for="senha">Senha (Acesso)</label>
            <input type="password" class="form-control" disabled placeholder="*********"/>
        </div>
        <div class="col-6">
            <label class="form-label" for="email">E-mail</label>
            <input type="text" class="form-control" name="email" value="<?php echo $colaboradores['email'] ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <label class="form-label" for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" value="<?php echo $colaboradores['nome'] ?>" />
        </div>
        <div class="col-3">
            <label class="form-label" for="sobrenome">Sobrenome</label>
            <input type="text" class="form-control" name="sobrenome" value="<?php echo $colaboradores['sobrenome'] ?>"/>
        </div>
        <div class="col-3">
            <label class="form-label" for="status">Status</label>
            <select name="status" class="form-control">
                <option value="1" <?php if ($colaboradores['status'] == 1) echo 'selected'; ?> >Ativo</option>
                <option value="0" <?php if ($colaboradores['status'] == 0) echo 'selected'; ?>>Desativado</option>
                <option value="0" <?php if ($colaboradores['status'] == 2) echo 'selected'; ?>>Bloqueado</option>
            </select>    
        </div>
        <div class="col-3">
            <label class="form-label" for="tipo">Tipo</label>
            <select name="tipo" class="form-control" value="<?php echo $colaboradores['tipo'] ?>">
                <option value="2" <?php if ($colaboradores['tipo'] == 2) echo 'selected'; ?> >Administrador</option>
                <!-- <option value="1" <?php if ($colaboradores['tipo'] == 1) echo 'selected'; ?> >Fornecedor</option> -->
                <option value="0" <?php if ($colaboradores['tipo'] == 0) echo 'selected'; ?> >Normal</option>
            </select>    
        </div>
        <div class="col-12 mt-5">
            <input class="btn btn-primary" type="submit" name="submit" value="Atualizar" />
        </div>
    </div>
</form>
<?php } else {?>
    <div class="alert alert-warning" role="alert">
        Voc&ecirc; n&atilde;o tem permiss&atilde;o para esta &aacute;rea.
    </div>
<?php }?>
</div>