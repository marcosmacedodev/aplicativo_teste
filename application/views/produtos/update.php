<?php
if (!$this->session->userdata('logged_in')) redirect(site_url('login'));
?>

<div class="container mt-5">
<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('produtos/update/' . $produtos['produto_ID']); ?>
    <div class="row">
        <div class="col-3">
            <label class="form-label" for="nome">Nome de produto</label>
            <input type="text" class="form-control" name="nome" value="<?php echo $produtos['produto_nome'] ?>" />
        </div>
        <div class="col-3">
            <label class="form-label" for="preco">Pre&ccedil;o</label>
            <input type="text" class="form-control" name="preco" value="<?php echo $produtos['preco'] ?>"/>
        </div>
        <div class="col-3">
            <label class="form-label" for="estoque">Em estoque</label>
            <input type="number" class="form-control" name="estoque" value="<?php echo $produtos['estoque'] ?>" />
        </div>
        <div class="col-3">
            <label class="form-label" for="descricao">Descri&ccedil;&atilde;o</label>
            <input type="text" class="form-control" name="descricao" value="<?php echo $produtos['descricao'] ?>"/>
        </div>
        <div class="col-3">
            <label class="form-label" for="status">Status</label>
            <select name="status" class="form-control">
                <option value="0" <?php if ($produtos['status'] == 0) echo 'selected'; ?> >Inativo</option>
                <option value="1" <?php if ($produtos['status'] == 1) echo 'selected'; ?>>Ativo</option>
            </select>    
        </div>

        <div class="col-12 mt-5">
            <input class="btn btn-primary" type="submit" name="submit" value="Atualizar" />
        </div>
    </div>
</form>

</div>