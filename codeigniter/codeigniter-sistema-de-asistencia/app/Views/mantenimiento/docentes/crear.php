
<div class="container">

  <h1>Agregar Nuevo Docente</h1>
  <br/>

  <div class="">
    <div class="">

      <form action="<?= site_url('/guardarDocente') ?>" method="post" enctype="multipart/form-data">

        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="dni" id="dni" required='true' autofocus>
                    <div id="respuesta"> </div>
                </div>
            </div>
        </div>

        

        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group mr-4">
                    <label for="nombres">Nombres:</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mr-4">
                    <label for="apellidopaterno">Apellido Paterno:</label>
                    <input type="text" class="form-control" id="apellidopaterno" name="apellidopaterno" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="apellidomaterno">Apellido Materno:</label>
                    <input type="text" class="form-control" id="apellidomaterno" name="apellidomaterno" required>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group mr-5">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sexo">Genero:</label>
                    <select class="form-control" id="sexo" name="sexo" required>
                        <option value="" selected disabled>Seleccionar genero</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                    </select>
                </div>
            </div>
        </div>

        

        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                  <label for="correo">Correo:</label>
                  <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                  <label for="username">Nombre de usuario:</label>
                  <input type="text" class="form-control" id="username" name="username" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
        </div>

        <hr>

        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="curso_id">Curso ID<span class="required"> *</span></label>
                    <select class="form-control" name="curso_id" required>
                        <option value="" selected disabled>Seleccionar curso</option>
                        <?php foreach ($cursos as $curso) : ?>
                            <option value="<?= $curso['id'] ?>">
                                <?= $curso['id'] . ' - ' . $curso['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="aula_id">Aula ID<span class="required"> *</span></label>
                    <select class="form-control" name="aula_id" required>
                        <option value="" selected disabled>Seleccionar aula</option>
                        <?php foreach ($aulas as $aula) : ?>
                            <option value="<?= $aula['id'] ?>">
                                <?= $aula['id'] . ' - ' . $aula['nombre'] . ' - ' . $aula['seccion'] . ' - ' . $aula['nivel'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>
        <a href="<?= base_url('listarDocentes'); ?>" class="btn btn-info" >Regresar</a>
      </form>
      
    </div>
  </div>
</div>






<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    function mostrarError(mensaje) {
        swal({
            title: "Lo sentimos",
            text: mensaje,
            icon: "error",
            buttons: ["Cancelar", "Aceptar"],
            dangerMode: true,
        });
    }

    
    <?php if (session()->has('mensaje')): ?>
        mostrarError("<?= session('mensaje') ?>");
    <?php endif; ?>
</script>