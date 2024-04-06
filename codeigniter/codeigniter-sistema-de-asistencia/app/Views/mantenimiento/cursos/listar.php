<div class="container">

    <h1>Lista de Cursos</h1>
    <hr>
    <a href="<?= base_url('crearCurso') ?>" class="btn btn-primary">Agregar Nuevo Curso</a>
    <hr>

    <div class="table-responsive">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Categoria</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursos as $curso) : ?>
                    <tr class="">
                        <td><?= $curso['id']; ?></td>
                        <td><?= $curso['nombre']; ?></td>
                        <td><?= $curso['descripcion']; ?></td>
                        <td><?= $curso['categoria']; ?></td>
                        <td>
                            <img src="<?= base_url() ?>/uploads/<?= $curso['imagen']; ?>" class="img-thumbnail" width="100" alt="">
                        </td>
                        <td>
                            <a href="<?= base_url('editarCurso/' . $curso['id']); ?>" class="btn btn-info">Editar</a>
                            <!-- <a href="< ?= base_url('borrarCurso/' . $curso['id']); ?>" class="btn btn-danger">Eliminar</a> -->
                            <!-- <button onclick="BloquearAccion()" class="btn btn-info">Editar</button>   -->
                            <button onclick="BloquearAccion()" class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>




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