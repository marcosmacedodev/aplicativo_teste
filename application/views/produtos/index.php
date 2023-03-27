<?php
if (!$this->session->userdata('logged_in')) redirect(site_url('login'));

function strStatusProduto($status){
    switch($status){
        case 0: return "Indisponível";
        case 1: return "Disponível";
        case 2: return "Bloqueado";
        default: return "Desconhecido";
    }
}
?>
<div class="container mt-5">

<a class="btn btn-primary" href="<?php echo site_url('produtos/create'); ?>">CRIAR
    </a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Pre&ccedil;o</th>
                <th>Estoque</th>
                <th>Descri&ccedil;&atilde;o</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($produtos as $produto){ ?>
                <tr>
                    <td><?= $produto['produto_ID'] ?></td>
                    <td><?= $produto['produto_nome'] ?></td>
                    <td><?= $produto['preco'] ?></td>
                    <td><?= $produto['estoque'] ?></td>
                    <td><?= $produto['descricao'] ?></td>
                    <td><?= strStatusProduto($produto['status']) ?></td>
                    <td><a href="<?php echo site_url('produtos/update/' . $produto['produto_ID']) ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>