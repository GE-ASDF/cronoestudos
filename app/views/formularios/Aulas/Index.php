<?php if(isset($aulas)): ?>
<section class="container mt-4">
<div class="mensagem"></div>
<div class="d-flex row gap-2">
<?php 
    $qtdAulasAssistidas = 0;
    foreach($aulas as $aula){
        if($aula["assistiu"]){
            $qtdAulasAssistidas = $qtdAulasAssistidas + 1;
        }
    }
?>
    <div class="col-md-3 bg-light p-2 ">
        <div class="title">
            <h4><?php echo $curso->nome ?></h4>
            <h5>Professor: <?php filtrarProfessor($professores, $curso) ?></h5>
        </div>
        <div style="border-radius:100%" class="container-image d-flex justify-content-center">
            <img style="border-radius:100%;width:250px;max-width:250px;height:250px; max-height:250px;" src="<?php echo URL_BASE ?>upload/<?php echo $curso->foto ?>" class="img-fluid" alt="Responsive image">
        </div>
        <div id="progresso" class="progresso mt-2">
            <span class="text">Progresso <?php
            $progresso = count($qtdAulas) > 0 ? number_format(($qtdAulasAssistidas / count($qtdAulas) * 100), 2) ."%":"0.00%" ;
            echo $progresso;
            ?> | 100%</span>
                <div class="progress" style="text-align:left; max-width:100%">
                    <div class="progress bg-primary" style="width:<?php echo $progresso ?>">  
                </div>
            </div>
        </div>
    </div>

    <?php if($aulas): ?>
    <div class="col-md p-2" style="min-height: 500px;">

    <?php foreach($aulas as $aula): ?>
        <p>
            <a style="display:block;text-align:left" class="btn btn-primary" data-bs-toggle="collapse" href="#n<?php echo $aula["idaula"] ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                <?php echo "Aula ".$aula["nraula"] ." - ".$aula["aula"] ?>
            </a>
        </p>
            <div class="collapse" id="n<?php echo $aula["idaula"] ?>">
                    <form class="concluir-aula">
                        <label for="concluir-<?php echo $aula["idaula"] ?>">Concluir aula</label>
                        <input type="hidden" name="idaula" value="<?php echo $aula["idaula"] ?>">
                        <button id="concluir-<?php echo $aula["idaula"] ?>" style="border:none;outline:none" class="btn">
                        <i class='material-icons'><?php echo $aula["assistiu"] ? "check":"check_box_outline_blank" ?></i>
                        </button>
                    </form>
                <div class="card card-body">
                    <div class="card card-content p-2">
                        <p class="d-flex flex-column"><?php echo $aula["descricao"] ?>
                        <a style="width:max-content" href="<?php echo $aula["link"] != "n" && $aula["link"] != null ? $aula["link"]:null  ?>" class="btn btn-success mt-2">Acessar conteúdo</a>
                        </p>
                    </div>
                    <div class="card card-content p-2">
                        <p class="d-flex flex-column"> Material de apoio
                            <a style="width:max-content" href="<?php echo $aula["material_apoio"] != "n" && $aula["material_apoio"] != null ? $aula["material_apoio"]:null ?>" class="btn btn-success mt-2">Acessar conteúdo</a>
                        </p>
                    </div>
                    <div class="card card-content p-2">
                        <p class="d-flex flex-column"> Exercícios
                            <a style="width:max-content" href="<?php echo $aula["exercicios"] != "n" && $aula["exercicios"] != null ? $aula["exercicios"]:null ?>" class="btn btn-success mt-2">Acessar conteúdo</a>
                        </p>
                    </div>
                    <div class="card card-content p-2">
                        <p class="d-flex flex-column"> Simulados
                            <a style="width:max-content" href="<?php echo $aula["simulados"] != "n" && $aula["simulados"] != null ? $aula["simulados"]:null ?>" class="btn btn-success mt-2">Acessar conteúdo</a>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
 <?php endif; ?>
</div>

</section>
<?php else: return redirect(URL_BASE."meuscursos"); endif; ?>
<script src="<?php echo URL_BASE ?>app/views/assets/concluir-aula.js"></script>

