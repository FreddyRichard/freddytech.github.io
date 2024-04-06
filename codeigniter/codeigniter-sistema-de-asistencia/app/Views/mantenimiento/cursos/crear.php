<div class="container">

  <h1>Agregar nuevo curso</h1>
  <br/>

  <div class="row">
    <div class="col-md-4 offset-md-0.5">

      <form action="<?= site_url('/guardarCurso') ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">

          <label for="nombre">Nombre<span class="required"> *</span></label>
          <input type="text" class="form-control" name="nombre" value="<?= old('nombre') ?>" required>
        </div>

        <div class="form-group">
          <label for="descripcion">Descripcion</label>
          <input type="text" class="form-control" name="descripcion">
        </div>

        <div class="form-group">
            <label for="categoria">Categoría<span class="required"> *</span></label>
            <select class="form-control" name="categoria" required>
                <option value="">Seleccionar categoría</option>
                <option value="Ciencia y Tecnología">Ciencia y Tecnología</option>
                <option value="Comunicación">Comunicación</option>
                <option value="Historia">Historia</option>
                <option value="Matemática">Matemática</option>
            </select>
        </div>

        <div class="form-group">
          <label for="imagen">Imagen</label>
          <input id="imagen" class="form-control-file" type="file" name="imagen">
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>
        <a href="<?= base_url('listarCursos'); ?>" class="btn btn-info" >Regresar</a>
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