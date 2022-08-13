
<section class="container mt-4">
  <h1>Cadastrar aulas</h1>
<?php echo getFlash("message") ?>
<form method="POST" action="<?php echo URL_BASE . "cadastraraulas/create" ?>" enctype="multipart/form-data">
  <div class="form-group mt-4">
    <label for="exampleInputEmail1">Importar arquivo XML:</label>
    <input type="file" name="arquivo" class="form-file" id="nome" aria-describedby="emailHelp" placeholder="Digite o título..">
    <?php echo getFlash("nome") ?>
    <label for="exampleInputEmail1">obrigatório</label>
</div>
<div class="form-group mt-4">
    <label for="idcurso">Curso:</label>
    <select name="idcurso" class="form-select" id="curso">
        <?php if($cursos): ?>
        <?php foreach($cursos as $curso): ?>
        <option value="<?php echo $curso->idcurso ?>"><?php echo $curso->nome ?></option>
        <?php endforeach; ?>
        <?php endif; ?> 
    </select>
    <?php echo getFlash("idcurso") ?>
    <label for="exampleInputEmail1">obrigatório</label>
</div>
  <button type="submit" class="mt-4 btn btn-primary">Salvar</button>
</form>

</section>

<script>

    const insertParagrafo = document.querySelector("#paragrafo");
    const negrito = document.querySelector("#negrito");
    
    insertParagrafo.addEventListener("click", function(){
      let descricao = document.querySelector("#descricao");
        descricao.value += "\\n";
    })

</script>