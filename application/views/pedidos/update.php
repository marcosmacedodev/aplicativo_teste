<?php
if (!$this->session->userdata('logged_in')) redirect(site_url('login'));
?>
<div class="container mt-5">
<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open(site_url('pedidos/update/' . $pedidos['pedido_ID'])); ?>
    <div class="row">
    <div class="col-3">
            <label class="form-label" for="num_pedido">N&uacute;mero do pedido</label>
            <input type="text" name="num_pedido" class="form-control" disabled value="<?php echo $pedidos['num_pedido']; ?>" />
        </div>
        <div class="col-3">
        
            <label class="form-label" for="fornecedor_ID">Fornecedor</label>
            <input type="text" class="form-control" value="<?php echo $pedidos['fornecedor_ID'] . ' (' . $razao_social. ')'; ?>" disabled />

        </div>
        <div class="col-3">
            <label class="form-label" for="data">Data</label>
            <input type="date" class="form-control" disabled value="<?php echo date("Y-m-d", strtotime($pedidos['data']))?>"/>
        </div>
        <div class="col-3">
            <label class="form-label" for="status">Status</label>
            <select name="status" class="form-control">
                <option value="0" <?php if ($pedidos['status'] == 0) echo 'selected'; ?> >Finalizado</option>
                <option value="1" <?php if ($pedidos['status'] == 1) echo 'selected'; ?>>Ativo</option>
            </select>    
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <label class="form-label" for="observacao">Observa&ccedil;&atilde;o</label>
            <textarea class="form-control" name="observacao" placeholder="Observação sobre o pedido"><?php echo $pedidos['observacao']?></textarea>
        </div>
    </div>

    <div class="col-12 mt-5">
            <input class="btn btn-primary" type="submit" name="submit" value="Atualizar" />
    </div>
</form>



</div>