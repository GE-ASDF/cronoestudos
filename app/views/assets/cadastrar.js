let formCadastrar = document.querySelector("#cadastrarUsuario")
let mensagem = document.querySelector(".mensagem")
window.onload = function(){

    formCadastrar.onsubmit = function(e){
        e.preventDefault();
        var form = new FormData(formCadastrar);
        xmlHttpPost("login/cadastrar", function(){
            beforeSend(function(){
                console.log("carregando");
            });
            success(function(){
                var response = xhttp.responseText;
                if(response == "cadastrado"){
                    mensagem.innerHTML = `<span class="alert alert-success"> Cadastrado com sucesso </span>`
                }
                if(response == "erro"){
                    mensagem.innerHTML = `<span class="alert alert-danger"> Tente novamente. </span>`
                
                }
            })
        }, form)
    }
}