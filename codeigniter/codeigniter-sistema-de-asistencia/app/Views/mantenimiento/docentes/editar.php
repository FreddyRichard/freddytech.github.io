<div class="container">
    <h1>Actualizar Docente</h1>
    <br/>
    <div class="">
        <div class="">
            <form action="<?= site_url('/actualizarDocente') ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $docente['id'] ?>">

                <div class="form-row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dni">DNI<span class="required"> *</span></label>
                            <input type="text" class="form-control" name="dni" value="<?= $dni; ?>">
                            <div id="respuesta"> </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group mr-4">
                            <label for="nombres">Nombres:</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" value="<?= $nombres; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mr-4">
                            <label for="apellidopaterno">Apellido Paterno:</label>
                            <input type="text" class="form-control" id="apellidopaterno" name="apellidopaterno" value="<?= $apellidoPaterno; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="apellidomaterno">Apellido Materno:</label>
                            <input type="text" class="form-control" id="apellidomaterno" name="apellidomaterno" value="<?= $apellidoMaterno; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group mr-5">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $telefono; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <select class="form-control" id="sexo" name="sexo" required>
                                <option value="">Seleccionar género</option>
                                <option value="Femenino" <?= ($sexo == 'Femenino') ? 'selected' : '' ?>>Femenino</option>
                                <option value="Masculino" <?= ($sexo == 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="<?= $correo; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="username">Nombre de usuario:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $username; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Se mantiene la contraseña">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <label for="curso_id">Curso ID<span class="required"> *</span></label>
                    <select class="form-control" name="curso_id">
                        <?php foreach ($cursos as $curso) : ?>
                            <option value="<?= $curso['id'] ?>" <?= ($curso['id'] == $docente['curso_id']) ? 'selected' : '' ?>>
                                <?= $curso['id'] . ' - ' . $curso['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="aula_id">Aula ID<span class="required"> *</span></label>
                    <select class="form-control" name="aula_id">
                        <?php foreach ($aulas as $aula) : ?>
                            <option value="<?= $aula['id'] ?>" 
                            <?= ($aula['id'] == $docente['aula_id']) ? 'selected' : '' ?>>
                                <?= $aula['id'] . ' - ' . $aula['nombre'] . ' - ' . $aula['seccion'] . ' - ' . $aula['nivel'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="<?= base_url('listarDocentes'); ?>" class="btn btn-info" >Regresar</a>
            </form>

        </div>
    </div>
</div>