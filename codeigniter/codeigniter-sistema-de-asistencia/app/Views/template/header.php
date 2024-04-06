<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Estilos personales de CSS public -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>




<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">

      <ul class="navbar-nav mr-auto">

        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('/') ?>">Inicio</a>
        </li>

        <li class="nav-item dropdown">
          <?php if ($loggedIn && ($isRolDirector || $isRolOficina)): ?>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Mantenimiento
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                <a class="dropdown-item" href="<?= base_url('listarAlumnos') ?>">Alumnos</a>

              <a class="dropdown-item" href="<?= base_url('listarAulas') ?>">Aulas</a>
              <a class="dropdown-item" href="<?= base_url('listarCursos') ?>">Cursos</a>
              <a class="dropdown-item" href="<?= base_url('listarDocentes') ?>">Docentes</a>
              <?php if ($isRolDirector): ?>
                <a class="dropdown-item" href="<?= base_url('listarUsuarios') ?>">Usuarios</a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </li>
        <!-- ----------------------------------------------------------- -->
        <?php if ($loggedIn && $isRolDocente): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('docente/cursos') ?>">Mis cursos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('listarAsistencias') ?>">Asistencias</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('docente/evaluaciones') ?>">Evaluaciones</a>
          </li>
        <?php endif; ?>
        <!-- ----------------------------------------------------------- -->
        <?php if ($loggedIn && $isRolAlumno): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('alumno/cursosActuales') ?>">Mis cursos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('alumno/notas') ?>">Mis notas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('alumno/horario') ?>">Horario de clases</a>
          </li>
        <?php endif; ?>


          <!-- ------------------------IDENTIFICADOR-------------------------- -->
          <?php if ($loggedIn && $isRolOficina): ?>
              <li class="nav-item">
                <a class="nav-link" href="#">OFICINA</a>
            <?php endif; ?>

            <?php if ($loggedIn && $isRolDirector): ?>
              <li class="nav-item">
                <a class="nav-link" href="#">DIRECTOR</a>
              </li>
            <?php endif; ?>

            <?php if ($loggedIn && $isRolDocente): ?>
              <li class="nav-item">
                <a class="nav-link" href="#">DOCENTE</a>
              </li>
            <?php endif; ?>

            <?php if ($loggedIn && $isRolAlumno): ?>
              <li class="nav-item">
                <a class="nav-link" href="#">ALUMNO</a>
              </li>
            <?php endif; ?>
          <!-- ----------------------------------------------------------- -->
      </ul>
      <!-- ----------------------------------------------------------- -->
      <ul class="navbar-nav">
        <?php if ($loggedIn): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('logout') ?>">Cerrar Sesión</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('login') ?>">Iniciar Sesión</a>
          </li>
        <?php endif; ?>

      </ul>



    </div>
  </nav>