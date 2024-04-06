<div class="container">
    <h1>Lista de usuarios</h1>
    <hr>
    <a href="<?= base_url('crearUsuario') ?>" class="btn btn-primary">Agregar Nuevo usuario</a>
    <hr>

    <div class="table-responsive">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="<?= site_url('listarUsuarios/id') ?>" id="filtroId" class="filter-link">
                            ID <?php if ($filtroActivo && $orden === 'id'): ?><i class="bi bi-funnel"></i><?php else: ?><i class="bi bi-funnel-fill"></i><?php endif; ?>
                        </a>
                    </th>
                    <th>DNI</th>
                    <th>
                        <a href="<?= site_url('listarUsuarios/nombres') ?>" id="filtroNombres" class="filter-link">
                            Usuario <?php if ($filtroActivo && $orden === 'nombres'): ?><i class="bi bi-funnel-fill"></i><?php else: ?><i class="bi bi-funnel"></i><?php endif; ?>
                        </a>
                    </th>
                    <th>Telefono</th>
                    <th>Sexo</th>
                    <th>Correo</th>
                    <th>Nombre de usuario</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario) : ?>
                    <tr class="">
                        <td><?= $usuario->id; ?></td>
                        <td><?= $usuario->dni; ?></td>
                        <td><?= $usuario->nombres.' '.$usuario->apellidopaterno.' '.$usuario->apellidomaterno; ?></td>
                        <td><?= $usuario->telefono; ?></td>
                        <td><?= $usuario->sexo; ?></td>
                        <td><?= $usuario->correo; ?></td>
                        <td><?= $usuario->username; ?></td>
                        <td><?= $usuario->rol; ?></td>

                        <td>
                            <a href="<?= base_url('editarUsuario/' . $usuario->id); ?>" class="btn btn-info">Editar</a>
                            <a href="<?= base_url('borrarUsuario/' . $usuario->id); ?>" class="btn btn-danger">Eliminar</a>
                            <!-- <button onclick="BloquearAccion()" class="btn btn-info">Editar</button>   -->
                            <!-- <button onclick="BloquearAccion()" class="btn btn-danger">Eliminar</button> -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    var listarUsuarios = '<?= site_url('listarUsuarios') ?>';
    var filtroActivo = <?= $filtroActivo ? 'true' : 'false' ?>;
</script>
<input type="hidden" id="filtroActivo" value="<?= $filtroActivo ? '1' : '0' ?>">



<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    function BloquearAccion() {
        swal({
            title: "Lo sentimos",
            text: "Esta acción no esta disponible \n en la version Demo",
            icon: "error",
            buttons: ["Cancelar", "Aceptar"],
            dangerMode: true,
        });
    }
</script>




