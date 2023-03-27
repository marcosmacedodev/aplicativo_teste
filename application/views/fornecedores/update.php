<?php

if (!$this->session->userdata('logged_in')) redirect(site_url('login')); ?>

<div class="container mt-5">
<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('fornecedores/update/'.$fornecedores['fornecedor_ID']); ?>
    <div class="row">
        <div class="col-3">
            <label class="form-label" for="">Raz&atilde;o social</label>
            <input type="text" class="form-control" name="razao_social" value="<?php echo $fornecedores['razao_social']; ?>" />
        </div>
        <div class="col-3">
            <label class="form-label" for="nome_fantasia">Nome fantasia</label>
            <input type="text" class="form-control" name="nome_fantasia" value="<?php echo $fornecedores['nome_fantasia']; ?>"/>
        </div>
        <div class="col-3">
            <label class="form-label" for="contato">Contato</label>
            <input type="text" class="form-control" name="contato" value="<?php echo $fornecedores['contato']; ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <label class="form-label" for="atividade">Atvidade</label>
            <input type="text" class="form-control" name="atividade" value="<?php echo $fornecedores['atividade']; ?>"/>
        </div>
        <div class="col-3">
            <label class="form-label" for="descricao">Descri&ccedil;&atilde;o</label>
            <input type="text" class="form-control" name="descricao" value="<?php echo $fornecedores['descricao']; ?>" />
        </div>
        <div class="col-3">
            <label class="form-label" for="status">Status</label>
            <select name="status" class="form-control">
                <option value="0" <?php if ($fornecedores['status'] == 0) echo 'selected'; ?> >Desativado</option>
                <option value="1" <?php if ($fornecedores['status'] == 1) echo 'selected'; ?> >Ativo</option>
            </select>    
        </div>
        <div class="col-12 mt-5">
            <input class="btn btn-primary" type="submit" name="submit" value="Atualizar" />
        </div>
    </div>
</form>
</div>