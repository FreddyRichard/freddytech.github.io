
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-0.5">

            <form action="<?= site_url('/actualizarAula') ?>" method="post">
                <input type="hidden" name="id" value="<?= $aula['id'] ?>">

                <div class="form-group">
                    <label for="nombre">Nombre<span class="required"> *</span></label>
                    <select class="form-control" name="nombre" required>
                        <option value="">Seleccionar nombre</option>
                        <option value="Primero" <?= ($aula['nombre'] == 'Primero') ? 'selected' : '' ?>>Primero</option>
                        <option value="Segundo" <?= ($aula['nombre'] == 'Segundo') ? 'selected' : '' ?>>Segundo</option>
                        <option value="Tercero" <?= ($aula['nombre'] == 'Tercero') ? 'selected' : '' ?>>Tercero</option>
                        <option value="Cuarto" <?= ($aula['nombre'] == 'Cuarto') ? 'selected' : '' ?>>Cuarto</option>
                        <option value="Quinto" <?= ($aula['nombre'] == 'Quinto') ? 'selected' : '' ?>>Quinto</option>
                        <option value="Sexto" <?= ($aula['nombre'] == 'Sexto') ? 'selected' : '' ?>>Sexto</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="seccion">Sección</label>
                    <select class="form-control" name="seccion" required>
                        <option value="">Seleccionar sección</option>
                        <option value="A" <?= ($aula['seccion'] == 'A') ? 'selected' : '' ?>>A</option>
                        <option value="B" <?= ($aula['seccion'] == 'B') ? 'selected' : '' ?>>B</option>
                        <option value="C" <?= ($aula['seccion'] == 'C') ? 'selected' : '' ?>>C</option>
                        <option value="D" <?= ($aula['seccion'] == 'D') ? 'selected' : '' ?>>D</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nivel">Nivel<span class="required"> *</span></label>
                    <select class="form-control" name="nivel" required>
                        <option value="">Seleccionar nivel</option>
                        <option value="Inicial" <?= ($aula['nivel'] == 'Inicial') ? 'selected' : '' ?>>Inicial</option>
                        <option value="Primaria" <?= ($aula['nivel'] == 'Primaria') ? 'selected' : '' ?>>Primaria</option>
                        <option value="Secundaria" <?= ($aula['nivel'] == 'Secundaria') ? 'selected' : '' ?>>Secundaria</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="vacanteTotal">Vacantes<span class="required"> *</span></label>
                    <input type="numeric" class="form-control" name="vacanteTotal" value="<?= $aula['vacanteTotal']; ?>">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="<?= base_url('listarAulas'); ?>" class="btn btn-info" >Regresar</a>
            </form>

        </div>
    </div>
</div>