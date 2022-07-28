<section class="container  mt-4 d-flex flex-column">
    
    <div class="header row">
        <div class="mb-2 header-title title">
            Lista de usuários
        </div>
        <div class="form-group col-md-4" id="search">
            <label for="searchInput">Pesquisar</label>
            <input type="text" id="txtBusca" class="form-control" placeholder="Pesquise por um usuário...">
        </div>
    </div>
    <div id="listaUsuarios" class="mt-4 overflow-auto">
        <?php if(isset($usuarios)): ?>
        <table class="table table-dark table-striped">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php foreach($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo $usuario->idusuario ?></td>
                    <td><?php echo $usuario->nome ." ". $usuario->sobrenome ?></td>
                    <td><?php echo $usuario->email ?></td>
                    <td>
                        <a href="<?php echo URL_BASE . "usuarios/editar" ?>" class="mx-1 flex-grow-1" style="color:white"><i class="material-icons">edit</i></a>
                    </td>
                    <td>
                        <a href="<?php echo URL_BASE . "usuarios/deletar" ?>"" class="mx-1 flex-grow-1" style="color:white"><i class="material-icons">delete</i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    </div>

</section>
<script>

        const TXTBUSCA = document.querySelector("#txtBusca");
        const tbody = document.querySelector("#tbody");
        
        TXTBUSCA.addEventListener("keyup", function(){

            let filtro = TXTBUSCA.value.toLowerCase().trim();
            let tr = tbody.getElementsByTagName("tr")
            
            for(let posicao in tr){

                if(true === isNaN(posicao)){
                    continue;
                }
                let value = tr[posicao].innerHTML.toLowerCase().trim();
                if(true === value.includes(filtro)){
                    tr[posicao].style.display = '';
                }else{
                    tr[posicao].style.display = "none"
                }
            }

        })

</script>