
<section class="container mt-4">
  <h1>Cadastrar cursos</h1>
<?php echo getFlash("message") ?>
<form method="POST" action="<?php echo URL_BASE . "cursos/create" ?>" enctype="multipart/form-data">
  <div class="form-group mt-4">
    <label for="exampleInputEmail1">Título do curso</label>
    <input value="<?php echo getOld("nome") ?>" type="text" name="nome" class="form-control" id="nome" aria-describedby="emailHelp" placeholder="Digite o título..">
    <?php echo getFlash("nome") ?>
    <label for="exampleInputEmail1">obrigatório</label>
</div>
<div class="form-group mt-4">
    <label for="professor">Professor:</label>
    <select name="professor" class="form-select" id="professor">
        <?php if($professores): ?>
        <?php foreach($professores as $professor): ?>
        <option value="<?php echo $professor->idprofessor ?>"><?php echo $professor->nome ?></option>
        <?php endforeach; ?>
        <?php endif; ?> 
    </select>
    <?php echo getFlash("professor") ?>
    <label for="exampleInputEmail1">obrigatório</label>
</div>
<div class="form-group mt-4">
    <label for="descricao">Descrição:</label><br>
    <div id="acoes" class="d-flex">

    <div id="paragrafo" style="margin-right:5px;cursor:pointer">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-paragraph" viewBox="0 0 16 16">
        <path d="M10.5 15a.5.5 0 0 1-.5-.5V2H9v12.5a.5.5 0 0 1-1 0V9H7a4 4 0 1 1 0-8h5.5a.5.5 0 0 1 0 1H11v12.5a.5.5 0 0 1-.5.5z"/>
      </svg>
    </div>
    
    </div>
    <textarea name="descricao" class="form-control" id="descricao" rows="4"><?php echo getOld("descricao") ?></textarea>
    <?php echo getFlash("descricao") ?>
    <label for="descricao">obrigatório. Use \n para quebra de parágrafos.</label>
</div>
<div class="form-group mt-4">
    <label for="foto">Imagem</label>
    <input name="foto" type="file" class="form-control-file" id="foto">
    <?php echo getFlash("foto") ?>
</div>
<div class="form-group mt-4">
    <label for="datacadastro">Data de cadastro:</label>
    <input name="datacadastro" type="date" class="form-control-date" id="datacadastro">
    <?php echo getFlash("data_publicacao") ?>
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