<section class="container mt-4 fadeInDown" data-anime="300">
    <div class="header container mb-4">
        <h1>Nosso blog</h1>
        <div id="search" class="col-md-4">
            <input type="text" id="txtBusca" class="form-control" placeholder="Pesquisar novidade...">
        </div>
    </div>
<div id="tbody" class="row gap-2 fadeInDown" data-anime="300">
    <?php if(isset($news)): ?>
        <?php foreach($news as $new): ?>
        <div class="linha card col-md-3">
        <div class="content linha d-flex flex-column align-items-start">
                <div class="col card-body">
                    <h5 class="card-title fs-1"><?php echo $new->titulo ?></h5>
                    <p class="card-text"> <?php echo formatDate($new->data_publicacao) ?></p>
                </div>
                <div style="background-image:url('<?php echo URL_BASE ?>upload/<?php echo $new->imagem?>');background-size:cover;height:300px;width:100%;background-position:center center" class="card-body col-md">
                    <!-- <img style="max-height: 100%; width:100%" src="<?php echo URL_BASE ?>upload/<?php echo $new->imagem?>"> -->
                </div>
                <p class="card-text mt-2">
                    <?php
                        echo paragrafar($new->conteudo, true);
                    ?>
                  </p>
            <a href="<?php echo URL_BASE . "blog/detalhe/" . $new->id ?>" class="btn btn-primary mb-2">Leia mais</a>
            </div>
        </div>  
        <?php endforeach; ?>   
    <?php endif; ?>
</div>

</section>