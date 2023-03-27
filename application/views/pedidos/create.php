<?php 
    if (!$this->session->userdata('logged_in')) redirect(site_url('login'));

?>
<div class="container mt-5">
<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('pedidos/create'); ?>
    <div class="row">
        <?php if (isset($pedido)){  ?>
        <input type="hidden" name="pedido_ID" value="<?php echo $pedido['pedido_ID']; ?>" />
        <?php } ?>
        <div class="col-3">
            <label class="form-label" for="num_pedido">N&uacute;mero do pedido</label>
            <input type="text" name="num_pedido" class="form-control" value="<?php echo set_value('num_pedido'); ?>" />
        </div>
        <div class="col-3">
        
            <label class="form-label" for="fornecedor_ID">Fornecedor</label>
            <select name="fornecedor_ID" class="form-control">
                <option value="">Selecione uma op&ccedil;&atilde;o</option>
            <?php foreach($fornecedores as $fornecedor){ ?>
                <option value="<?php echo $fornecedor['fornecedor_ID']; ?>"  <?php echo  set_select('fornecedor_ID', $fornecedor['fornecedor_ID']); ?>   ><?php echo $fornecedor['razao_social']; ?></option>
            <?php } ?>
            </select> 

        </div>
        <?php if(isset($pedido)) { ?>
        <div class="col-3">
            <label class="form-label" for="data">Data</label>
            <input type="date" class="form-control" disabled value="<?php echo date("Y-m-d", strtotime($pedido['data'])) ?>"/>
        </div>
        <div class="col-3">
            <label class="form-label" for="status">Status</label>
            <select name="status" class="form-control">
                <option value="1" <?php if ($pedido['status'] == 1) echo 'selected'; ?> >Ativo</option>
                <option value="0" <?php if ($pedido['status'] == 0) echo 'selected'; ?>>Finalizado</option>
            </select>    
        </div>
        <?php }?>
    </div>


    <div class="row">
        <div class="col-6">
            <label class="form-label" for="observacao">Observa&ccedil;&atilde;o</label>
            <textarea class="form-control" name="observacao" placeholder="Deixe sua observação"><?php echo set_value('observacao'); ?></textarea>
        </div>
    </div>

    <div class="col-12 mt-5">
            <input class="btn btn-primary" type="submit" name="submit" value="Criar" />
    </div>

</form>


</div>