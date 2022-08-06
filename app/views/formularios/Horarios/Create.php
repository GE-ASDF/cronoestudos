<section class="container" style="overflow:hidden">
    <div class="mensagem mb-4 mt-4">
        <?php echo getFlash("message") ?>
    </div>
    <h1 class="title mt-4">Cadastrar horários</h1>
        <div class="row">
        <div class="col-md-4">
            <label for="inicio">Horário de início</label>
            <input type="text" name="inicio" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="fim">Qtd. ciclos</label>
            <input type="text" name="fim" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="fim">A cada</label>
            <select name="acada" id="acada" class="form-select">
                </select>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="p-2">
                    <button class="btn btn-primary mt-4 mb-4" id="criarHorarios">Gerar horários</button>
                </div>
                <div class="p-2">
                    <button class="btn btn-danger mt-4 mb-4" id="limpar">Limpar</button>
                </div>
                <form action="<?php echo URL_BASE ."horarios/delete"?>" method="POST">
                    <input type="hidden" name="idusuario" value="<?php echo IDUSUARIO ?>">
                    <button class="btn btn-danger mt-4 mb-4" id="limpar">Resetar horários</button>
                </form>
            </div>
        </div>
        <div id="resultado">
            <form method="POST" action="<?php echo URL_BASE . "horarios/create" ?>">
            <input type="hidden" name="idusuario" value="<?php echo IDUSUARIO ?>">
            
            <div class="horarios">
                
                </div>
                
                <div class="botao mt-4">
                    
                    </div>
                    
                </form>
            </div>
        </section>
        <script src="<?php echo URL_BASE ?>app/views/assets/createschedules/minutos.js"></script>
        <script src="<?php echo URL_BASE ?>app/views/assets/createschedules/horarios.js"></script>