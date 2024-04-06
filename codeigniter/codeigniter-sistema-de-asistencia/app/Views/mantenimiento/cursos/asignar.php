<div class="container">
    <h1>Asignar Cursos</h1>
    <hr>

    <div class="table-responsive">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>DNI</th>
                    <th>Docente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($docentes as $docente) : ?>
                    <tr class="">
                        <td><?= $docente->id; ?></td>
                        <td><?= $docente->dni; ?></td>
                        <td><?= $docente->nombres.' '.$docente->apellidopaterno.' '.$docente->apellidomaterno; ?></td>
                        <td>
                            <a href="<?= base_url('crearAsignacionCurso/' . $docente->id); ?>" class="btn btn-info">Asignar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
