<?= $header ?>


<div class="container">

  <h1>Agregar nuevo curso</h1>
  <br/>

  <div class="row">
    <div class="col-md-4 offset-md-0.5">
      <form action="<?= site_url('/guardar') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nombre">Nombre<span class="required"> *</span></label>
          <input type="text" class="form-control" name="nombre" value="<?= old('nombre') ?>">
        </div>

        <div class="form-group">
          <label for="description">Descripcion</label>
          <input type="text" class="form-control" name="description">
        </div>

        <div class="form-group">
          <label for="categoria">Categoria<span class="required"> *</span></label>
          <input type="text" class="form-control" name="categoria">
        </div>

        <div class="form-group">
          <label for="imagen">Imagen</label>
          <input id="imagen" class="form-control-file" type="file" name="imagen">
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>
        <a href="<?= base_url('listar'); ?>" class="btn btn-info" >Regresar</a>
      </form>
    </div>
  </div>
</div>



<?= $footer ?>










