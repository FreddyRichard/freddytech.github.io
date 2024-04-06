<div class="container">
    <h1>Actualizar Docente</h1>
    <br/>
    <div class="">
        <div class="">
            <form action="<?= site_url('/guardarAsignacionCurso') ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $docente->id ?>">

                <div class="form-row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dni">DNI</label>
                            <input type="text" class="form-control" name="dni" value="<?= $docente->dni; ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Docente</label>
                            <input type="text" class="form-control" name="" value="<?= $docente->nombres.' '.$docente->apellidopaterno.' '.$docente->apellidomaterno; ?>" readonly>
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


                <br/>

                <button type="submit" class="btn btn-primary">Asignar</button>
                <a href="<?= base_url('listarDocentes'); ?>" class="btn btn-info" >Regresar</a>
            </form>

        </div>
    </div>
</div>