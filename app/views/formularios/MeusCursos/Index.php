<section class="container mt-4 fadeInDown" data-anime="300">
    <div class="header container mb-4">
        <h1>Meus cursos</h1>
        <div id="search" class="col-md-4">
            <input type="text" id="txtBusca" class="form-control" placeholder="Pesquisar curso...">
        </div>
    </div>
    <div id="tbody" class="row gap-2 fadeInDown" data-anime="300">
    <?php if(isset($cursos)): ?>
        <?php foreach($cursos as $curso): ?>
        <div class="linha card col-md-3">
        <div class="content linha d-flex flex-column align-items-start">
                <div class="col card-body">
                    <h5 class="card-title fs-1"><?php echo $curso["curso"] ?></h5>
                    <span>Professor: <?php echo $curso["professor"] ?></span>
                </div>
                <div class="card-body col ">
                    <img src="<?php URL_BASE ?>assets/img/<?php echo $curso["foto"]?>" class="img-fluid" alt="Responsive image" alt="">
                    <div class="card-footer">
                        <span><?php echo $curso["descricao"] ?></span>
                        <a href="<?php echo URL_BASE . "aulas/" . $curso["idcurso"] ?>" class="btn mt-2 btn-success">Iniciar curso</a>
                    </div>
                </div>
            </div>
        </div>  
        <?php endforeach; ?>   
    <?php endif; ?>
</div>
</section>
