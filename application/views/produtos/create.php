<?php

    if (!$this->session->userdata('logged_in')) redirect(site_url('login'));
?>
<div class="container mt-5">

<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('produtos/create'); ?>
    <div class="row">
        <div class="col-3">
            <label class="form-label" for="fornecedor">Fornecedor</label>
            <select name="fornecedor" class="form-control">
                <option value="" selected>Selecione uma op&ccedil;&atilde;o</option>
            <?php foreach($fornecedores as $fornecedor){ ?>
                <option value="<?php echo $fornecedor['fornecedor_ID']; ?>"><?php echo $fornecedor['razao_social']; ?></option>
            <?php } ?>
            </select>  
        </div>
        <div class="col-3">
            <label class="form-label" for="nome">Nome de produto</label>
            <input type="text" class="form-control" name="nome" />
        </div>
        <div class="col-3">
            <label class="form-label" for="preco">Pre&ccedil;o de compra</label>
            <input type="text" class="form-control" name="preco" />
        </div>
        <div class="col-3">
            <label class="form-label" for="estoque">Em estoque</label>
            <input type="number" class="form-control" name="estoque" />
        </div>
        <div class="col-3">
            <label class="form-label" for="descricao">Descri&ccedil;&atilde;o</label>
            <input type="text" class="form-control" name="descricao" />
        </div>
        <div class="col-3">
            <label class="form-label" for="status">Status</label>
            <select name="status" class="form-control">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
                <option selected value="">Selecione uma op&ccedil;&atilde;o</option>
            </select>    
        </div>

        <div class="col-12 mt-5">
            <input class="btn btn-primary" type="submit" name="submit" value="Criar" />
        </div>
    </div>
</form>

</div>