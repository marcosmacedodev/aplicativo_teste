<?php
if (!$this->session->userdata('logged_in')) redirect('login');
        function strStatusFornecedor($status){
            switch($status){
                case 0: return "Desativado";
                case 1: return "Ativo";
                default: return "Desconhecido";
            }
        }
    ?>
    
    <div class="container mt-5">  
    <a class="btn btn-primary" href="<?php  echo site_url('fornecedores/create'); ?>">CRIAR
    </a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Raz&atilde;o social</th>
                <th>Nome fantasia</th>
                <th>Contato</th>
                <th>Atividade</th>
                <th>Status</th>
                <th>Descri&ccedil;&atilde;o</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($fornecedores as $fornecedor){ ?>
                <tr>
                    <td><?= $fornecedor['fornecedor_ID'] ?></td>
                    <td><?= $fornecedor['razao_social'] ?></td>
                    <td><?= $fornecedor['nome_fantasia'] ?></td>
                    <td><?= $fornecedor['contato'] ?></td>
                    <td><?= $fornecedor['atividade'] ?></td>
                    <td><?= strStatusFornecedor($fornecedor['status'])?></td>
                    <td><?= $fornecedor['descricao']?></td>
                    <td><a href="<?php echo site_url('fornecedores/update/'. $fornecedor['fornecedor_ID']); ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a></td>
                </tr>
                <?php } ?>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>