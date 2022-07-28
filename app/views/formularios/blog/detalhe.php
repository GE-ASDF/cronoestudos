<?php if(isset($news)): ?>
<section class="container mt-4 d-grid fadeInDown" data-anime="300">
<div class="blog-content d-flex flex-column justify-content-center align-items-center">

<div class="header">
    <div class="title-news">
        <h1 class="title fs-1">
            <?php echo $news->titulo ?>
        </h1>
        <span>Data de publicação 
        <?php echo formatDate($news->data_publicacao) ?>
        </span>
        </div>
    <div class="content-imagem">
        <img src="<?php echo URL_BASE?>assets/img/course.jpg" width="780" class="img-fluid" alt="Responsive image">
    </div>
</div>
<div class="body mt-4">
    <div class="body-text container fs-5">
       <?php echo $news->conteudo ?>
    </div>
</div>
    
</div>
</section>
<?php endif; ?>