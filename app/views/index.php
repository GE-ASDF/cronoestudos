
<section style="background-image:url('<?php echo URL_BASE ?>assets/img/course.jpg');background-position:center center;background-size:cover;" class="container mt-4 d-grid cards fadeInDown" data-anime="100">

<div class="row gap-2 fadeInDown" data-anime="300">
    <div style="width:max-content" class="card">
        <div style="width:max-content" class="d-flex flex-column card-body">
            <h5 class="card-img col-md-4 fs-1">
                <img src="<?php echo URL_BASE ?>assets/img/course.jpg" width="100" height="100" style="border-radius:50%" alt="">
            </h5>
            <div class="card-text d-flex flex-column flex-wrap">
                <p style="margin-bottom:-4px" class="">Bem-vindo(a), <?php echo $_SESSION[SESSION_LOGIN]->nome ?></p>
                <a class="nav-link text-primary" href="<?php echo URL_BASE . "perfil" ?>">Meu perfil</a>
            </div>
            </div>
        </div>
    </div>
</section>
    
    <!-- início dos cards da home -->
    <section class="container mt-4 d-grid cards fadeInRight" data-anime="300">

    <div class="row gap-2 justify-content-center">
        <div class="card col-md w-75">
        <div class="content d-flex align-items-start">
                <div class="colbg-primary card-body">
                    <h5 class="card-title fs-1"><?php echo $qtd_cursos[0]->qtd ?></h5>
                    <p class="card-text">qtd cursos matriculado</p>
                </div>
                <div class="card-body colbg-primary">
                    <i class="large material-icons">school</i>
                </div>
            </div>
        </div>

        <div class="card col-md w-75">
            <div class="content d-flex align-items-start">
                <div class="colbg-primary card-body">
                    <h5 class="card-title fs-1">
                        <?php
                         echo isset($qtd_aulas_assistidas) ? count($qtd_aulas_assistidas):0  
                         ?>
                    </h5>
                    <p class="card-text">qtd aulas assistidas</p>
                </div>
                <div class="card-body colbg-primary">
                    <i class="large material-icons">done</i>
                </div>
            </div>
        </div>

        <div class="card col-md w-75">
        <div class="content d-flex align-items-start">
                <div class="colbg-primary card-body">
                    <h5 class="card-title fs-1">
                    <?php
                         echo isset($qtd_cursos_assistidos) ? count($qtd_cursos_assistidos):0  
                         ?>
                    </h5>
                    <p class="card-text">qtd cursos concluídos</p>
                </div>
                <div class="card-body colbg-primary">
                    <i class="large material-icons">done_all</i>
                </div>
            </div>
        </div>

    </div>

    </section>
    <!-- fim dos cards da home -->

    <!-- Início da área de tabelas da home -->
    <section class="container mt-4 d-grid fadeInDown" data-anime="300">

        <div class="row gap-1">

            <section class="col-md tabela">
                <div class="container-title">
                    <h3 class="title text-center">Meus cursos</h3>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Data da matrícula</th>
                            <th>Curso</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                       <?php  foreach($cursos as $curso): ?>
                        <tr>
                            <td><?php echo formatDate($curso["data"]) ?></td>
                            <td>
                                <a class="nav-link" href="<?php echo URL_BASE . "aulas/assistir/" . $curso["idcurso"] ?>"> <?php echo $curso["curso"] ?> </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
            </section>
                           
            <section class="col-md tabela">
            <div class="container-title">
                    <h3 class="title text-center">Novidades</h3>
                    <div id="search" class="row">
                        <input type="text" id="txtBusca" class="form-control col-md-1" placeholder="Pesquisar novidade...">
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Novidade</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                       <?php if($news): ?>
                        <?php foreach($news as $new): ?>
                        <tr class="linha">
                            <td>
                                <?php echo formatDate($new->data_publicacao) ?>
                            </td>
                            <td>
                                <a href="<?php echo URL_BASE . "blog/detalhe/" . $new->id ?>" class="nav-link">
                                    <?php echo $new->titulo ?>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>

        </div>

    </section>

