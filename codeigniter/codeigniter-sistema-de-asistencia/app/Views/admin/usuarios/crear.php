<div class="container">

  <h1>Agregar nuevo curso</h1>
  <br/>

  <div class="row">
    <div class="col-md-4 offset-md-0.5">

      <form action="<?= site_url('/guardarUsuario') ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label for="username">Nombre de Usuario<span class="required"> *</span></label>
          <input type="text" class="form-control" name="username" value="<?= old('username') ?>">
        </div>

        <div class="form-group">
          <label for="password">Contraseña<span class="required"> *</span></label>
          <input type="text" class="form-control" name="password" value="<?= old('password') ?>">
        </div>

        <div class="form-group">
          <label for="dni">DNI<span class="required"> *</span></label>
          <input type="text" class="form-control" name="dni" value="<?= old('dni') ?>">
        </div>

        <div class="form-group">
          <label for="rol">Rol<span class="required"> *</span></label>
          <input type="text" class="form-control" name="rol" value="<?= old('rol') ?>">
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>
        <a href="<?= base_url('listarUsuarios'); ?>" class="btn btn-info" >Regresar</a>
      </form>
    </div>
  </div>
</div>