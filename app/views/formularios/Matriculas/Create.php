<script>
    
window.onload = function(){
    let usuarioValue = 1;
    let valoresCursos;
    let usuarioSelect = document.querySelector("#usuario");
    let cursosMatriculado = document.querySelector("#cursos-matriculado");
    let allCursos = document.querySelector("#all-cursos");
    usuarioSelect.onchange = function(){
        xmlHttpGet("matriculas/listarcursos", function(){
            beforeSend(function(){
                usuarioValue = usuarioSelect.value
            })
            success(function(){
                allCursos.innerHTML = '';
                let response = JSON.parse(xhttp.responseText);
                allCursos.innerHTML = imprimir(response)    
                let cursos = allCursos.querySelectorAll("input");
                cursos.forEach(curso=>{
                    curso.addEventListener("change", function(e){
                        xmlHttpGet("matriculas/delete", function(){
                            beforeSend(function(){

                            })
                            success(function(){
                                let response = xhttp.responseText

                            })
                        },"?idcurso="+e.currentTarget.value+"&idusuario="+usuarioSelect.value)
                    })
                });          
            })
        }, "?idusuario="+usuarioSelect.value);
    }

}

function imprimir(dados){
    let table ='';
    let a = 0
    for(let i = 0; i < dados.length;i++){

        if(dados[i].matriculado == true){
        
            table += 
            ` <div class="form-check form-switch">
            <input value="${dados[i].idcurso}" data-checked="true" checked name="idcurso[]" class="form-check-input" type="checkbox" id="n${dados[i].idcurso}">
            <label class="form-check-label" for="n${dados[i].idcurso}">${dados[i].nome}</label>
            </div>
            `
        }else{
            table += 
            ` <div class="form-check form-switch">
            <input data-checked="false" value="${dados[i].idcurso}" name="idcurso[]" class="form-check-input" type="checkbox" id="n${dados[i].idcurso}">
            <label class="form-check-label" for="n${dados[i].idcurso}">${dados[i].nome}</label>
            </div>
        `
        }
      
    }
    return table
}
</script>


<section class="container mt-4">
  <h1>Matricular usuário</h1>
<?php echo getFlash("message") ?>
<form method="POST" action="<?php echo URL_BASE . "matriculas/create" ?>" enctype="multipart/form-data">

    <div class="form-group mt-4">
        
        <select id="usuario" name="idusuario" class="form-select" id="">
            <?php if($usuarios): ?>
                <option>Escolha um usuário...</option>
                <?php foreach($usuarios as $usuario): ?>
                    <option value="<?php echo $usuario->idusuario ?>"><?php echo $usuario->nome . " " . $usuario->sobrenome ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    
    </div>
    <div id="App" class="form-group mt-4 row d-flex flex-column">
    <div id="cursos-matriculado">
        <ul>
            <li>Para matricular o aluno em algum curso, basta clicar na caixa de marcação. Para confirmar a matrícula clique em salvar.</li>
            <li>Para desmatricular o aluno de algum curso, basta clicar na caixa de marcação. Neste caso, <strong>não</strong> é necessário clicar em salvar.</li>
        </ul>
    </div>
    <p class="btn btn-primary" @click="markAll()" style="cursor:pointer;width:max-content">Marcar todos </p>        
    <?php if($cursos): ?>
    <div id="all-cursos" class="col-md">
            
    </div>
    <?php endif; ?>
    </div>

<button type="submit" class="mt-4 btn btn-primary">Salvar</button>
</form>

</section>

<script>
    const vm = new Vue({
        el: "#App",
        data:{},
        methods:{
            markAll(event){
                let options = document.querySelectorAll("#all-cursos input");
                options.forEach(i=>{
                    let isChecked = i.getAttribute("data-checked")

                    if(isChecked == "false"){
                    i.setAttribute("data-checked", "true")
                    i.click();
                }
                   
                });
            },

        }

    })
</script>