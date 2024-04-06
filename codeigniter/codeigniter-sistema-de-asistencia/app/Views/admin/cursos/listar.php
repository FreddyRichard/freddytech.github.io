<?= $header ?>


<div class="container">

    <h1>Lista de Cursos</h1>
    <hr>
    <a href="<?= base_url('crear') ?>" class="btn btn-primary">Agregar Nuevo Curso</a>
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
                            <a href="<?= base_url('editar/' . $curso['id']); ?>" class="btn btn-info">Editar</a>
                            <a href="<?= base_url('borrar/' . $curso['id']); ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<?= $footer ?>