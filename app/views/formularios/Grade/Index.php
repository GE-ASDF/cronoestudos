<section class="container mt-4 mb-4 fadeInDown" data-anime="100">
    
<div class="mensagem mb-4 mt-4">
        <?php echo getFlash("message") ?>
    </div>
    <h1>Grade de horários</h1>

    <form method="POST" action="<?php echo URL_BASE. "grade/create" ?>">
    <input type="hidden" name="idusuario" value="<?php echo IDUSUARIO ?>">
    <div class="row">
        <div class="col-md">
            <label for="dia">Dia da semana</label>
            <?php if($dias):?>
            <select name="iddia" class="form-select" id="dia">
                <?php foreach($dias as $dia): ?>
                    <option value="<?php echo $dia->iddia ?>"><?php echo $dia->dia ?></option>
                <?php endforeach; ?>
            </select>
            <?php endif;?>
        </div>
        <div class="col-md">
        <label for="horario">Horário</label>
            <?php if($horarios):?>
            <select name="idhorario" class="form-select" id="dia">
                <?php foreach($horarios as $horario): ?>
                    <option value="<?php echo $horario->idhorario ?>"><?php echo $horario->horario ?></option>
                <?php endforeach; ?>
            </select>
            <?php else: ?>
                <?php echo "<br> Você não possui horários cadastrados <br>"; ?>
                <a class="nav-link btn btn-light" href="<?php echo URL_BASE ."horarios"?> ">Cadastrar agora</a>
            <?php endif;?>
        </div>
        <div class="col-md">
        <label for="horario">Curso</label>
        <?php if($cursos):?>
            <select name="idcurso" class="form-select" id="dia">
                <?php foreach($cursos as $curso): ?>
                    <option value="<?php echo $curso["idcurso"] ?>"><?php echo $curso["curso"] ?></option>
                <?php endforeach; ?>
            </select>
            <?php else: ?>
                <?php echo "<br> Você precisa estar matriculado em um curso primeiro. <br>"; ?>
            <?php endif;?>
        </div>
        <div class="row mt-4">
            <div class="col-md-2">
                <button class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
    </div>
</section>

    <section class="container-fluid mt-4">

        <div class="row">
   
            <?php if($dias): ?>
                <?php foreach($dias as $dia): ?>
            <div class="col-md p-1 m-1 fs-6 text-center fadeInDown" data-anime="200">
                <div class="card d-flex">
                    <div class="car-header">
                       <p><?php echo $dia->dia ?></p>
                    </div>
                    
                    <?php foreach($horarios as $horario): ?>
                        <section class="d-flex flex-column">                  
                        <div class="card-body">
                            <?php echo $horario->horario; ?>
                        </div>
                    <!--- INÍCIO DOS CARDS -->
                    <?php foreach($grade as $agendado): ?>
                    <?php if($agendado->idhorario == $horario->idhorario && $agendado->iddia == $dia->iddia): ?>
                    <div class="card text-white bg-primary mt-3 mb-3 fadeInDown" data-anime="300" style="max-width: 18rem;">
                        <div class="card-header d-flex flex-column">
                            <h5><?php echo $agendado->nome ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <a href="<?php echo URL_BASE . "aulas/assistir/" . $agendado->idcurso ?>" class="btn btn-success mx-2"><i class="material-icons">play_arrow</i></a>
                                <form action="<?php echo URL_BASE ."grade/delete" ?>" method="POST" class="d-flex">
                                <input type="hidden" value="<?php echo $agendado->idhorario ?>" name="idhorario">    
                                <input type="hidden" value="<?php echo $agendado->idcurso ?>" name="idcurso">    
                                <input type="hidden" value="<?php echo $agendado->iddia ?>" name="iddia">    
                                <input type="hidden" value="<?php echo IDUSUARIO ?>" name="idusuario">    
                                <button class="btn btn-danger"><i class="material-icons">delete</i></button>
                            </form>
                        </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <!--- FIM DOS CARDS -->
                </section>                
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    
    </section>

</section>


