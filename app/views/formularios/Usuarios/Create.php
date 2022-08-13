<section id="usuarios" class="container mt-4">

    <h2 class="title fs-2">Cadastro de usuários</h2>
    <span class="mb-4 mt-4">
        <?php echo getFlash("message") ?>
    </span>
    <form action="<?php echo URL_BASE . "usuarios/create" ?>" method="post" enctype="multipart/form-data">
    <div class="row p-2">

        <div class="col-md-4 p-2 d-flex flex-column">
            <div class="text-center d-flex justify-content-center p-2">
                <img id="imagem-perfil" alt="imagem do perfil" style="min-height:250px;width:250px;max-width:250px;max-height:250px;border-radius:50%">
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="form-group">
                    <input @change="selectInput" type="file" name="foto" value="<?php echo getOld("foto") ?>" class="form-control" id="foto">
                </div>
            </div>
            <?php echo getFlash("foto") ?>
        </div>

        <div class="col-md p-3 right">
            <div class="card-header">
                <p>Dados pessoais</p>
            </div>

            <div class="form-group mb-2">
                <label for="nome" class="text form-label">Nome</label>
                <input type="text" id="nome" value="<?php echo getOld("nome") ?>" class="form-control" name="nome">
                <?php echo getFlash("nome") ?>
            </div>
            <div class="form-group mb-2">
                <label for="sobrenome" class="text form-label">Sobrenome</label>
                <input type="text" id="sobrenome" value="<?php echo getOld("sobrenome") ?>" class="form-control" name="sobrenome">
                <?php echo getFlash("sobrenome") ?>
            </div>
            <div class="row">

            <div class="col-md">
                <div class="form-group mb-2">
                    <label for="nascimento" class="text form-label">Data de nascimento</label>
                    <input type="text" id="nascimento" value="<?php echo getOld("nascimento") ?>" class="form-control" name="nascimento">
                    <?php echo getFlash("nascimento") ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group mb-2">
                    <label for="cpf" class="text form-label">CPF</label>
                    <input type="text" id="cpf" value="<?php echo getOld("cpf") ?>" class="form-control" name="cpf">
                    <?php echo getFlash("cpf") ?>
                </div>
            </div>
                
            </div>
            <div class="row">

            <div class="col-md">
                <div class="form-group mb-2">
                    <label for="email" class="text form-label">E-mail</label>
                    <input type="text" id="email" value="<?php echo getOld("email") ?>" class="form-control" name="email">
                    <?php echo getFlash("email") ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group mb-2">
                    <label for="senha" class="text form-label">Senha</label>
                    <input type="text" id="senha" value="<?php echo getOld("senha") ?>" class="form-control" name="senha">
                    <?php echo getFlash("senha") ?>
                </div>
            </div>
                
            </div>

        </div>

    </div>

    <div class="row p-2">

        <div class="card-header">
            <p>Endereço e contato</p>
        </div>

        <div class="row">

            <div class="col-md">
                <div class="form-group mb-2">
                    <label for="rua" class="text form-label">Rua</label>
                    <input type="text" value="<?php echo getOld("rua") ?>" id="rua" class="form-control" name="rua">
                <?php echo getFlash("rua") ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group mb-2">
                    <label for="numero" class="text form-label">Número</label>
                    <input type="text" id="numero" value="<?php echo getOld("numero") ?>" class="form-control" name="numero">
                    <?php echo getFlash("numero") ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group mb-2">
                    <label for="bairro" class="text form-label">Bairro</label>
                    <input type="text" id="bairro" value="<?php echo getOld("bairro") ?>" class="form-control" name="bairro">
                    <?php echo getFlash("bairro") ?>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-md">
                <div class="form-group mb-2">
                <label for="estado" class="text form-label">Estado</label>
                <select name="idestado" class="form-select" id="idestado">
                    <option> Selecione um estado </option>
                    <?php if($estados): ?>
                        <?php foreach($estados as $estado): ?>
                        <option value="<?php echo $estado->idestado ?>"> <?php echo $estado->nome ?> </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <?php echo getFlash("estado") ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group mb-2">
                    <label for="idcidade" class="text form-label">Cidade</label>
                    <select name="idcidade" class="form-select" id="idcidade">
                        <option> Selecione uma cidade </option>
                        <?php if($cidades): ?>
                            <?php foreach($cidades as $cidade): ?>
                            <option value="<?php echo $cidade->idcidade ?>"> <?php echo $cidade->nome ?> </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <?php echo getFlash("idcidade") ?>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-md">
                <div class="form-group mb-2">
                    <label for="telresidencial" class="text form-label">Telefone residencial</label>
                    <input type="text" id="telresidencial" value="<?php echo getOld("telresidencial") ?>" class="form-control" name="telresidencial">
                    <?php echo getFlash("telresidencial") ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group mb-2">
                    <label for="telcomercial" class="text form-label">Telefone comercial</label>
                    <input type="text" id="telcomercial" value="<?php echo getOld("telcomercial") ?>" class="form-control" name="telcomercial">
                    <?php echo getFlash("telcomercial") ?>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group mb-2">
                    <label for="celular" class="text form-label">Celular</label>
                    <input type="text" id="celular" value="<?php echo getOld("celular") ?>" class="form-control" name="celular">
                    <?php echo getFlash("celular") ?>
                </div>
            </div>

        </div>

        <div class="row mt-4">
            <div class="col-md">
                <input type="submit" class="btn btn-primary " value="Salvar">
            </div>
        </div>
    </div>
    
    </form>

</section>
  <script>
            const vm = new Vue({
                el:"#usuarios",
                data:{
                    inicio:0,
                    fim:0,
                },
                methods:{
                    selectInput(){
                        let imgInput = document.querySelector("#foto");
                        let imagemPerfil = document.querySelector("#imagem-perfil")
                        this.renderFile(imgInput, imagemPerfil);
                    },
                    renderFile(imgInput, imagemPerfil){
                        let reader = new FileReader();
                            reader.onload = function(){
                            imagemPerfil.src = reader.result;
                            }
                        reader.readAsDataURL(imgInput.files[0])
                    },
                }
            })
    </script>
<script>
    
    window.onload = function(){
        let idestado = document.querySelector("#idestado");
        let idcidade = document.querySelector("#idcidade");

        idestado.addEventListener("change", function(e){
            xmlHttpGet("usuarios/buscarCidades", function(){
                beforeSend(function(){

                })
                success(function(){
                    let response = JSON.parse(xhttp.responseText);
                    idcidade.innerHTML = imprimir(response);
                })
            },"?idestado="+idestado.value);
        })
    }

    function imprimir(dados){
    let table ='';
    for(let i = 0; i < dados.length;i++){
        
        table += 
        `
        <option value="${dados[i].idcidade}">
            ${dados[i].nome}
        </option>
        `
      
    }
    return table
}

</script>