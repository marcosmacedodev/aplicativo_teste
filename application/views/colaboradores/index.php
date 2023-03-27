<?php
if (!$this->session->userdata('logged_in')) redirect(site_url('login'));
?>
<?php
        function strStatusColaborador($status){
            switch($status){
                case 0: return "Inativo";
                case 1: return "Ativo";
                case 2: return "Bloqueado";
                default: return "Desconhecido";
            }
        }
        function strTipoColaborador($tipo){
            switch($tipo){
                case 0: return "Normal";
                case 1: return "Fornecedor";
                case 2: return "Administrador";
                default: return "Desconhecido";
            }
        }
    ?>
    
    <div class="container mt-5">
    <?php if ($this->session->userdata('tipo') == 2) {?>    
    <a class="btn btn-primary" href="<?php echo site_url('colaboradores/create'); ?>">CRIAR
    </a>
    <?php }?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usu&aacute;rio</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Status</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($colaboradores as $colaborador){ ?>
                <tr>
                    <td><?= $colaborador['colaborador_ID'] ?></td>
                    <td><?= $colaborador['usuario'] ?></td>
                    <td><?= $colaborador['nome'] ?></td>
                    <td><?= $colaborador['sobrenome'] ?></td>
                    <td><?= strStatusColaborador($colaborador['status']) ?></td>
                    <td><?= strTipoColaborador($colaborador['tipo']) ?></td>
                    <?php if ($this->session->userdata('tipo') == 2) {?>
                    <td><a href="<?php echo site_url('colaboradores/update/' .$colaborador['colaborador_ID']); ?>" class="btn btn-warning"><i class="bi bi-pencil"></i></a></td>
                    <?php }?>
                </tr>
                <?php } ?>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
            </div>