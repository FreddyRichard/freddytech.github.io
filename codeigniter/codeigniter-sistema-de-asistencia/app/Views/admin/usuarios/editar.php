<div class="container">
    <br>
    <div class="row">
        <div class="col-md-4 offset-md-0.5">

            <form action="<?= site_url('/actualizarUsuario') ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $usuario->id ?>">

                <div class="form-group">
                    <label for="username">Nombre de Usuario<span class="required"> *</span></label>
                    <input type="text" class="form-control" name="username" value="<?= $usuario->username; ?>">
                </div>

                <div class="form-group">
                    <label for="password">Contraseña<span class="required"> *</span></label>
                    <input type="password" class="form-control" name="password" placeholder="Ingrese una nueva contraseña">
                </div>

                <div class="form-group">
                    <label for="dni">DNI<span class="required"> *</span></label>
                    <input type="text" class="form-control" name="dni" value="<?= $usuario->dni; ?>">
                </div>

                <div class="form-group">
                    <label for="rol">Rol<span class="required"> *</span></label>
                    <input type="text" class="form-control" name="rol" value="<?= $usuario->rol; ?>">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="<?= base_url('listarUsuarios'); ?>" class="btn btn-info" >Regresar</a>
            </form>
        </div>
    </div>
</div>