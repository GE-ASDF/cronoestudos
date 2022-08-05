<?php if(isset($news)): ?>
<section class="container mt-4 d-grid fadeInDown" data-anime="300">
<div class="container blog-content d-flex flex-column justify-content-center">

<div class="">
    <div class="card mb-4">
        <h1 class="title fs-1">
            <?php echo $news->titulo ?>
        </h1>
        <span class="card-text">Data de publicação 
        <?php echo formatDate($news->data_publicacao) ?> | <?php echo $news->autor ?>
        </span>
    </div>
    <div class="content-imagem d-flex justify-content-center">
        <img src="<?php echo URL_BASE ?>upload/<?php echo $news->imagem?>" width="780" class="img-fluid" alt="Responsive image">
    </div>
</div>
<div class="card mt-4">
    <div class="card-body body-text container fs-5 mb-4" style="max-width:840px">
            <?php
                echo paragrafar($news->conteudo);
            ?>
    </div>
</div>
    
</div>
</section>
<?php endif; ?>