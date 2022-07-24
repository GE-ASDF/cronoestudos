<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
    <link rel="stylesheet" href="<?php echo URL_BASE ?>assets/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

    <div class="container-fluid">


        <header class="bg-blue">

            <?php include "cabecalho.php" ?>

        </header>

        <main class="container-fluid main auto-container">

            <div class="base auto-container">
                <?php $this->load($view, $viewData); ?>
            </div>

        </main>
    </div>
    
    <script src="<?php echo URL_BASE ?>assets/js/menu.js"></script>
</body>
</html>