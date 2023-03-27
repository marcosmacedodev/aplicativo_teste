
<?php

if ($this->session->userdata('logged_in')) redirect(site_url('pedidos')); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');

body {
    font-family: 'Inter', sans-serif;
    margin: 0;
    padding: 0;
    color: #023047
}

.page {
    display: flex;
    flex-direction: column;
    align-items: center;
    align-content: center;
    justify-content: center;
    width: 100%;
    height: 100vh;
}

.formLogin {
    display: flex;
    flex-direction: column;
    background-color: #fff;
    border-radius: 7px;
    padding: 40px;
    box-shadow: 10px 10px 40px rgba(0, 0, 0, 0.4);
    gap: 5px
}

.areaLogin img {
    width: 420px;
}

.formLogin h1 {
    padding: 0;
    margin: 0;
    font-weight: 500;
    font-size: 2.3em;
}

.formLogin p {
    display: inline-block;
    font-size: 14px;
    color: #666;
    margin-bottom: 25px;
}

.formLogin input {
    padding: 15px;
    font-size: 14px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    margin-top: 5px;
    border-radius: 4px;
    transition: all linear 160ms;
    outline: none;
}


.formLogin input:focus {
    border: 1px solid #f72585;
}

.formLogin label {
    font-size: 14px;
    font-weight: 600;
}

.formLogin a {
    display: inline-block;
    margin-bottom: 20px;
    font-size: 13px;
    color: #555;
    transition: all linear 160ms;
}

.formLogin a:hover {
    color: #f72585;
}
</style>
</head>
<body >
<div class="container">

    <div class="page">
        <?php 
    
            if($this->session->userdata('ip_blocked_time') && $this->session->userdata('ip_blocked_time') > time())
            {
                die('<p>Voc&ecirc; errou sua senha 3 vezes seguidas.</p> 
                <p>Seu endere&ccedil;o IP foi bloqueado.</p> 
                <p>Tente novamente em '. ($this->session->userdata('ip_blocked_time') - time()) . " segundos</p>");
            } 

        ?>
        <form method="POST" action="<?php echo site_url('login/autenticar'); ?>" class="formLogin">
            <h1>Login</h1>
            <p>Digite os seus dados de acesso no campo abaixo.</p>
            <label for="usuario">E-mail</label>
            <input type="text" name="usuario" placeholder="Digite seu usuário" autofocus="true" />
            <label for="text">Senha</label>
            <input type="password" name="senha" placeholder="Digite sua senha" />
            <!-- <a href="/">Esqueci minha senha</a> -->
                
    <?php if($this->session->flashdata('erro_login')){ ?>
        <p><?php echo $this->session->flashdata('erro_login'); ?></p>
        <?php 
            if($this->session->userdata('login_tentativas'))
            {
                $this->session->set_userdata('login_tentativas', $this->session->userdata('login_tentativas') + 1);
                if ($this->session->userdata('login_tentativas') >= 3)
                {
                    $this->session->set_userdata('login_tentativas', 0);
                    $this->session->set_userdata('ip_blocked_time', time() + (5 * 60));
                    redirect('login');
                }
            }
            else
            {
                $this->session->set_userdata('login_tentativas', 1);
            }
        ?>
    <?php } ?>
            <input type="submit" value="Acessar" class="btn btn-primary" />
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    </div>


</body>

</html>