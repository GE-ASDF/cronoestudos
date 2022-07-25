<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página de Login do cronoestudos">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo URL_BASE ?>assets/css/style.css">
    <!-- <link rel="stylesheet" href="<?php echo URL_BASE ?>assets/css/modal/modal.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script>
        document.documentElement.classList.add("js");
    </script>
</head>

    <div class="container-fluid">

        <div class="container">

            <section id="pg-login" class="base fadeInDown" data-anime="300">
            <?php echo getFlash("message") ?>
                <div class="login-form">

                    <form action="<?php echo URL_BASE . "login/logar"?>" method="POST" class="form fadeInDown" data-anime="100">
                        <div class="login-image">
                            <i class="material-icons large dark-blue fadeInDown" data-anime="200">group-id</i>
                            <span class="title detalhado fadeInDown" data-anime="200">cronoestudos</span>
                        </div>
                        <div class="form-item fadeInDown" data-anime="250">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control">
                            <?php echo getFlash("email") ?>
                        </div>

                        <div class="form-item fadeInDown" data-anime="250">
                            <label for="password">Senha</label>
                            <input type="password" name="senha" id="password" class="form-control">
                            <?php echo getFlash("senha") ?>
                        </div>

                        <div class="form-item">
                            <input type="submit" value="Logar" class="btn btn-primary">
                        </div>
                        <div class="open-modal">
                            <p class="btn btn-primary">Cadastre-se</p>
                        </div>
              
                    </form>
                    <div class="login-image">
                        


                    </div>
                </div>

            </section>

        </div>

    </div>
    
<div class="modal">

    <div class="login-form">
        
        <form action="<?php echo URL_BASE . "login/cadastrar" ?>" method="POST">

            <div class="close-modal">
                <i class="material-icons">close</i>
            </div>
            <div class="login-image">
                <span class="title fadeInDown" data-anime="200">Cadastre-se</span>
            </div>
            <div class="form-item fadeInDown" data-anime="250">
            <label for="nome">Nome</label>
                <input type="nome" name="nome" id="nome" class="form-control">
                <?php echo getFlash("nome") ?>
            </div>
            <div class="form-item fadeInDown" data-anime="250">
            <label for="sobrenome">Sobrenome</label>
                <input type="sobrenome" name="sobrenome" id="sobrenome" class="form-control">
                <?php echo getFlash("sobrenome") ?>
            </div>
        
            <div class="form-item fadeInDown" data-anime="250">
            <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="form-control">
                <?php echo getFlash("email") ?>
            </div>
                        
            <div class="form-item fadeInDown" data-anime="250">
                <label for="password">Senha</label>
                <input type="password" name="senha" id="password" class="form-control">
                <?php echo getFlash("senha") ?>
            </div>
                        
            <div class="form-item">
                <input type="submit" value="Cadastrar" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
    
    <script src="<?php echo URL_BASE ?>assets/js/simple-anime.js"></script>
    <script src="<?php echo URL_BASE ?>assets/js/script.js"></script>
    <script src="<?php echo URL_BASE ?>assets/js/modal.js"></script>
</body>
</html>