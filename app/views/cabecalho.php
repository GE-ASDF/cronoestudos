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
          <a class="nav-link active" href="<?php echo URL_BASE . "meuscursos" ?>">Meus cursos</a>
        </li>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li> -->
        <li class="nav-item">
          <a href="<?php echo URL_BASE ."perfil" ?>" class="nav-link active">Perfil</a>
        </li>
        <li class="nav-item">
          <a href="<?php echo URL_BASE . "horarios" ?>" class="nav-link active">Horários</a>
        </li>
        <li class="nav-item">
          <a href="<?php echo URL_BASE . "grade"?>" class="nav-link active">Grade</a>
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