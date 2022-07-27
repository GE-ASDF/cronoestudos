let formCadastrar = document.querySelector("#cadastrar-usuario")
let mensagem = document.querySelector(".mensagem")


window.onload = function(){

    formCadastrar.onsubmit = function(e){
        e.preventDefault();
        var form = new FormData(formCadastrar);
        xmlHttpPost("login/cadastrar", function(){
            beforeSend(function(){
                mensagem.innerHTML = `<span class="alert alert-success"> Carregando </span>`
            });
            success(function(){
                var response = xhttp.responseText;
                if(response == 1){
                    mensagem.innerHTML = `<span class="alert alert-success"> Cadastrado com sucesso </span>`
                }
                if(response == 0){
                    mensagem.innerHTML = `<span class="alert alert-danger">Cadastro não efetuado. Tente novamente. </span>`
                }
            })
        }, form)
    }
}