

<div class="container">
    <br>
    <h1>Lista de Usuarios</h1>
    <hr>
    <a href="<?= base_url('crearUsuario') ?>" class="btn btn-primary">Agregar Nuevo usuario</a>
    <hr>

    <div class="table-responsive">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>id</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>DNI</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) : ?>
                    <tr class="">
                        <td><?= $usuario->id; ?></td>
                        <td><?= $usuario->username; ?></td>
                        <td>**********</td> <!-- Valor oculto o mensaje de contraseña encriptada -->
                        <!-- <td>< ?= $usuario->password; ?></td> -->
                        <td><?= $usuario->dni; ?></td>
                        <td><?= $usuario->rol; ?></td>
                        <td>
                            <a href="<?= base_url('editarUsuario/' . $usuario->id); ?>" class="btn btn-info">Editar</a>
                            <a href="<?= base_url('borrarUsuario/' . $usuario->id); ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>