<html>
    <head>

    </head>

    <body>
        <h1>Bem-vindo, <?php echo $this->session->userdata('nome'); ?>!</h1>
        <a href="<?php echo site_url('login/sair'); ?>">Sair</a>
    </body>
</html>