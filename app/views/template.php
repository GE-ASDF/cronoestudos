<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="<?php echo URL_BASE ?>assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script>
        document.documentElement.classList.add("js");
    </script>
</head>
<body>

    <div class="container-fluid">


        <header>
        
            <?php
                if(!isset($_SESSION[SESSION_LOGIN]) || $_SESSION[SESSION_LOGIN]->colaborador != 1){
                    include "cabecalho.php";
                }elseif(isset($_SESSION[SESSION_LOGIN]) && $_SESSION[SESSION_LOGIN]->colaborador == 1){
                    include "cabecalhoadmin.php";
                }
             
             ?>

        </header>

        <main>

                <?php $this->load($view, $viewData); ?>

        </main>
    </div>
    <script src="<?php echo URL_BASE ?>assets/js/simple-anime.js"></script>
    <script src="<?php echo URL_BASE ?>assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>