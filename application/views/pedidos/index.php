<?php
if (!$this->session->userdata('logged_in')) redirect(site_url('login'));

function strStatusPedido($status){
    switch($status){
        case 0: return "Finalizado";
        case 1: return "Ativo";
        default: return "Desconhecido";
    }
}

?>
<div class="container mt-5">
        <a class="btn btn-primary" href="<?php echo site_url('pedidos/create'); ?>">CRIAR
        </a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Observa&ccedil;&atilde;o</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pedidos as $pedido){ ?>
                    <tr>
                        <td><?php echo $pedido['pedido_ID'];?></td>
                        <td><?php echo date("d/m/Y", strtotime($pedido['data'])); ; ?></td>
                        <!--<td><?php //echo $pedido['total']; ?></td>-->
                        <td><?php echo strStatusPedido($pedido['status']); ?></td>
                        <td><?php echo $pedido['observacao']; ?></td>
                        <td><a href="<?php echo site_url('pedidos/update/' .$pedido['pedido_ID']); ?> " class="btn btn-warning"><i class="bi bi-pencil"></i></a> <a href="<?php echo site_url('pedidos/delete/' .$pedido['pedido_ID']); ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
                        
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>

            </tfoot>
        </table>
</div>