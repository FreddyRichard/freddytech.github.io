
<div class="container">

  <h1>Agregar Nuevo Usuario</h1>
  <br/>

  <div class="">
    <div class="">

      <form action="<?= site_url('/guardarUsuario') ?>" method="post" enctype="multipart/form-data">

        <div class="form-row">
            <div class="col-md-4">
                <label for="name" class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni" id="dni" required='true' autofocus>
                <div id="respuesta"> </div>
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
                    <div id="telefono-error"></div>
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
            <div class="col-md-7">
                <div class="form-group">
                  <label for="correo">Correo:</label>
                  <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
            </div>
        </div>

        <div class="form-row">
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
            <div class="col-md-4">
                <div class="form-group">
                    <label for="rol">Rol:</label>
                    <select class="form-control" id="rol" name="rol" required>
                        <option value="" selected disabled>Seleccionar Rol</option>
                        <option value="Director">Director</option>
                        <option value="Oficina">Oficina</option>
                        <option value="Docente">Docente</option>
                        <option value="Alumno">Alumno</option>
                    </select>
                </div>
            </div>
        </div>

  
        <button type="submit" class="btn btn-primary" id="">Agregar</button>
        <a href="<?= base_url('listarUsuarios'); ?>" class="btn btn-info" >Regresar</a>
      </form>
      
    </div>
  </div>
</div>