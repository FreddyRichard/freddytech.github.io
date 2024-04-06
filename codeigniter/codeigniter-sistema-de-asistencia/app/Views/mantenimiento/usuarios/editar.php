
<div class="container">
    <h1>Actualizar Usuario</h1>
    <br/>
    <div class="">
        <div class="">
            <form action="<?= site_url('/actualizarUsuario') ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $usuario->id ?>">

                <div class="form-group">
                    <label for="dni">dni<span class="required"> *</span></label>
                    <input type="text" class="form-control" name="dni" value="<?= $usuario->dni; ?>">
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                    <div class="form-group mr-4">
                        <label for="nombres">Nombres:</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" value="<?= $usuario->nombres; ?>">
                    </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mr-4">
                            <label for="apellidopaterno">Apellido Paterno:</label>
                            <input type="text" class="form-control" id="apellidopaterno" name="apellidopaterno" value="<?= $usuario->apellidopaterno; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="apellidomaterno">Apellido Materno:</label>
                            <input type="text" class="form-control" id="apellidomaterno" name="apellidomaterno" value="<?= $usuario->apellidomaterno; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group mr-5">
                            <label for="telefono">Teléfono:</label>
                            <input type="number" class="form-control" id="telefono" name="telefono" value="<?= $usuario->telefono; ?>">
                            <div id="telefono-error" class="error-message"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <select class="form-control" id="sexo" name="sexo" required>
                                <option value="">Seleccionar género</option>
                                <option value="Femenino" <?= ($usuario->sexo == 'Femenino') ? 'selected' : '' ?>>Femenino</option>
                                <option value="Masculino" <?= ($usuario->sexo == 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-md-7">
                        <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="<?= $usuario->correo; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="username">Nombre de usuario:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $usuario->username; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Se mantiene la contraseña">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rol">Rol:</label>
                            <select class="form-control" id="rol" name="rol" required>
                                <option value="">Seleccionar Rol</option>
                                <option value="Director" <?= ($usuario->rol == 'Director') ? 'selected' : '' ?>>Director</option>
                                <option value="Oficina" <?= ($usuario->rol == 'Oficina') ? 'selected' : '' ?>>Oficina</option>
                                <option value="Docente" <?= ($usuario->rol == 'Docente') ? 'selected' : '' ?>>Docente</option>
                                <option value="Alumno" <?= ($usuario->rol == 'Alumno') ? 'selected' : '' ?>>Alumno</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="<?= base_url('listarUsuarios'); ?>" class="btn btn-info" >Regresar</a>
            </form>

        </div>
    </div>
</div>





