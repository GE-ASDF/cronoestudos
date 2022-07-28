<section class="container">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo URL_BASE ?>">cronoestudos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo URL_BASE ?>">Inicial</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Meus cursos</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Cadastros
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo URL_BASE ."usuarios" ?>">Usuários</a></li>
            <li><a class="dropdown-item" href="#">Cursos</a></li>
            <li><a class="dropdown-item" href="#">Aulas</a></li>
            <li><a class="dropdown-item" href="#">Horários</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Listar
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo URL_BASE . "listarusuarios" ?>">Usuários</a></li>
            <li><a class="dropdown-item" href="#">Cursos</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link active">Perfil</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link active">Grade</a>
        </li>
        <li class="nav-item">
          <a href="<?php echo URL_BASE . "blog"?>" class="nav-link active">Blog</a>
        </li>
        <li class="nav-item bg-danger">
          <a href="<?php echo URL_BASE . "login/logout" ?>" class="nav-link active p-2">Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

</section>