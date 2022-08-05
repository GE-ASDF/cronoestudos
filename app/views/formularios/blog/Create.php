
<section class="container mt-4">
  <h1>Postar no blog</h1>
<?php echo getFlash("message") ?>
<form id="App" method="POST" action="<?php echo URL_BASE . "blogcreate/create" ?>" enctype="multipart/form-data">
  <div class="form-group mt-4">
    <label for="exampleInputEmail1">Título</label>
    <input value="<?php echo getOld("titulo") ?>" type="text" name="titulo" class="form-control" id="titulo" aria-describedby="emailHelp" placeholder="Digite o título..">
    <?php echo getFlash("titulo") ?>
    <label for="exampleInputEmail1">obrigatório</label>
</div>
<div class="form-group mt-4">
    <label for="autor">Autor</label>
    <input value="<?php echo getOld("autor") ?>" type="text" name="autor" class="form-control" id="exampleInputPassword1" placeholder="Autor..">
    <?php echo getFlash("autor") ?>
    <label for="exampleInputEmail1">obrigatório</label>
</div>
<div class="form-group mt-4">
    <label for="conteudo">Conteúdo</label><br>   
    <textarea @keydown.enter="paragrafar" name="conteudo" class="form-control" id="conteudo" rows="4"><?php echo getOld("conteudo") ?></textarea>
    <?php echo getFlash("conteudo") ?>
    <label for="conteudo">obrigatório. Não apague o '\n'. Os parágrafos serão criados com o ele.</label>
</div>
<div class="form-group mt-4">
    <label for="foto">Imagem</label>
    <input name="imagem" type="file" class="form-control-file" id="foto">
    <?php echo getFlash("imagem") ?>
</div>
<div class="form-group mt-4">
    <label for="data_publicacao">Data de publicação:</label>
    <input name="data_publicacao" type="date" class="form-control-date" id="data_publicacao">
    <?php echo getFlash("data_publicacao") ?>
</div>
  <button type="submit" class="mt-4 btn btn-primary">Postar</button>
</form>

</section>
<script src="<?php echo URL_BASE ?>assets/js/vue.js"></script>

<script>

    const vm = new Vue({
      el:"#App",
      data:{
        localidade:{},
      },
      methods:{
        paragrafar(event){
          event.currentTarget.value += '\\n';
        },
      }
    })

</script>