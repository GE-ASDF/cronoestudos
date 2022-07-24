<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo URL_BASE ?>assets/style.css"">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="container height-100vh auto-container">
        <div class="height-100porc container formulario-login d-flex flex-column align-items-center justify-content-center">
            <?php echo getFlash("senha") ?>
            <?php echo getFlash("email") ?>
            <form action="<?php echo URL_BASE . "login/logar"?>" method="POST" class="container-fluid d-flex flex-column justify-content-center align-items-center">
            <i class="material-icons large mr-4 detalhe-login">person</i>
            <div class="form-item d-flex">
                <i class="material-icons large mr-4">mail</i><input class="form-control" type="email" name="email" id="email" placeholder="Digite seu e-mail">
            </div>
            
            <div class="form-item d-flex mt-16">
                <i class="material-icons large mr-4">password</i><input class="form-control" type="password" name="senha" id="senha" placeholder="Digite sua senha">
            </div>
            
            <div class="form-item d-flex mt-16 ">
                <input type="submit" class="btn btn-large btn-primary" value="Logar">
            </div>
            
        </form>
        
    </div>
    
</div>


</body>
</html>