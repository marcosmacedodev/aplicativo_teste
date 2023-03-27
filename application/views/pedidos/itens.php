<?php
if (!$this->session->userdata('logged_in')) redirect(site_url('login'));
?>
<div class="container">
<?php echo validation_errors(); ?>
<hr />
    <div class="row">
    <table class="table">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Valor unit&aacute;rio</th>
                <th></th>
            </tr>
        </thead>
        <body>
            <?php if(isset($itens))  foreach($itens as $item) { ?>
            <?php echo form_open(site_url('pedidos/update_item/' . $item['item_ID'])); ?>
            <tr>
                <td><?php echo $item['nome_item']; ?></td>
                <td><input type="number" name="quantidade" value="<?php echo $item['quantidade']; ?>" class="form-control" /></td>
                <td><input type="text" name="valor_unitario" value="<?php echo $item['valor_unitario']; ?>" class="form-control" /></td>
                <td><button type="submit" class="btn btn-warning" ><i class="bi bi-pencil"></i></button><?php if ($pedidos['status']){ ?> <a href="<?php echo site_url('pedidos/delete_item/' . $item['item_ID']); ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a><?php } ?></td>
            </tr>
            </form>
            <?php } ?>
            <?php if ($pedidos['status']) { ?>
            <tr>
                <div class="row">
                <?php echo form_open(site_url('pedidos/create_item/' . $pedidos['pedido_ID'])); ?>
                
                    <td>
                        <select name="produto_ID" class="form-control" value="1">
                        <option value="">Selecione um produto</option>
                        <?php foreach($produtos as $produto) { ?>
                            <option value="<?php echo $produto['produto_ID']; ?>" <?php echo set_select('produto_ID', $produto['produto_ID']); ?> ><?php echo $produto['produto_nome']; ?> </option>
                        <?php } ?>
                        </select>
                    </td>
                    <td><input type="number" name="quantidade" class="form-control" value="<?php echo set_value('quantidade'); ?>"/></td>
                    <td><input type="text" name="valor_unitario" class="form-control"  value="<?php echo set_value('valor_unitario'); ?>" /></td>
                    <td><button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i></button></td>
                    </div>
                </form>
            </tr>
            <?php } ?>
        </body>
    </table>
</div>
                        </div>