<div class="container">
    <h1>Agregar Nueva Aula</h1>
    <br/>
    <div class="row">
        <div class="col-md-4 offset-md-0.5">
            <form action="<?= site_url('guardarAula') ?>" method="post">
                <div class="form-group">
                    <label for="nombre">Grado<span class="required"> *</span></label>
                    <select class="form-control" name="nombre" required>
                        <option value="" selected disabled>Seleccionar grado</option>
                        <option value="Primero">Primero</option>
                        <option value="Segundo">Segundo</option>
                        <option value="Tercero">Tercero</option>
                        <option value="Cuarto">Cuarto</option>
                        <option value="Quinto">Quinto</option>
                        <option value="Sexto">Sexto</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="seccion">Seccion<span class="required"> *</span></label>
                    <select class="form-control" name="seccion" required>
                        <option value="" selected disabled>Seleccionar seccion</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nivel">Nivel<span class="required"> *</span></label>
                    <select class="form-control" name="nivel" required>
                        <option value="" selected disabled>Seleccionar nivel</option>
                        <option value="Inicial">Inicial</option>
                        <option value="Primaria">Primaria</option>
                        <option value="Secundaria">Secundaria</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="vacanteTotal">Vacante Total<span class="required"> *</span></label>
                    <input type="number" class="form-control" name="vacanteTotal" name="vacanteTotal">
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
                <a href="<?= base_url('listarAulas'); ?>" class="btn btn-info">Regresar</a>
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
