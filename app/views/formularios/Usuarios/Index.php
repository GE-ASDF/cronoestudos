<section class="container  mt-4 d-flex flex-column">
    <div class="mensagem"></div>
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
                    <th>Colaborador</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php foreach($usuarios as $usuario): ?>
                <tr class="linha">
                    <td><?php echo $usuario->idusuario ?></td>
                    <td><?php echo $usuario->nome ." ". $usuario->sobrenome ?></td>
                    <td><?php echo $usuario->email ?></td>
                    <td>
                        <form class="text-center atualizador">
                            <input type="hidden" name="idusuario" value="<?php echo $usuario->idusuario ?>">
                            <button class="btn-<?php echo $usuario->idusuario ?>" style="border:none;background:none;padding:none;margin:none;width:max-content;outline:none">
                                <i style="color:white;" class="material-icons"><?php echo $usuario->colaborador == 1 ? "check":"check_box_outline_blank" ?></i>
                            </button>
                        </form>
                        </td>
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
<script src="<?php echo URL_BASE ?>app/views/assets/ecolaborador.js"></script>