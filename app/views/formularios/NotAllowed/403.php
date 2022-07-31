<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="<?php echo URL_BASE ?>assets/css/style.css">
</head>
<body>
<section class="container-fluid" style="height:100vh;">
    <div style="height:100%" id="app">
        <div>403</div>
        <div class="txt d-flex flex-column justify-content-center align-items-center">
            <div class="txt d-flex flex-column justify-content-center align-items-center">
                Tentativa suspeita de acesso<br>
                Endereço IP: 
                <?php 
                    echo $_SERVER["REMOTE_ADDR"]
                ?><span class="blink">_</span>
            </div>
            <a href="<?php echo URL_BASE ?>">Voltar</a>
        </div>
    </div>
</section>
</body>
</html>
