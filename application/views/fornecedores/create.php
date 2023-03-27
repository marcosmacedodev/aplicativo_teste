<?php

if (!$this->session->userdata('logged_in')) redirect(site_url('login')); ?>

<div class="container mt-5">
<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open(site_url('fornecedores/create')); ?>
    <div class="row">
    <div class="col-3">
            <label class="form-label" for="cnpj">CNPJ</label>
            <input type="text" class="form-control" name="cnpj"/>
        </div>
        <div class="col-3">
            <label class="form-label" for="razao_social">Raz&atilde;o social</label>
            <input type="text" class="form-control" name="razao_social"/>
        </div>
        <div class="col-3">
            <label class="form-label" for="nome_fantasia">Nome fantasia</label>
            <input type="text" class="form-control" name="nome_fantasia" />
        </div>
        <div class="col-3">
            <label class="form-label" for="contato">Contato</label>
            <input type="text" class="form-control" name="contato" />
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <label class="form-label" for="atividade">Atvidade</label>
            <input type="text" class="form-control" name="atividade" />
        </div>
        <div class="col-3">
            <label class="form-label" for="descricao">Descri&ccedil;&atilde;o</label>
            <input type="text" class="form-control" name="descricao" />
        </div>
        <div class="col-3">
            <label class="form-label" for="status">Status</label>
            <select name="status" class="form-control">
                <option value="1">Ativo</option>
                <option value="0">Inativado</option>
                <option selected value="">Selecione uma op&ccedil;&atilde;o</option>
            </select>    
        </div>
        <div class="col-12 mt-5">
            <input class="btn btn-primary" type="submit" name="submit" value="Criar" />
        </div>
    </div>
</form>
</div>