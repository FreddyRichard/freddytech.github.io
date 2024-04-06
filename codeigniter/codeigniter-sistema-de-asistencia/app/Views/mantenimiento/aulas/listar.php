<div class="container">
    <h1>Aulas Disponibles</h1>
    <hr>
    <a href="<?= base_url('crearAula') ?>" class="btn btn-primary">Agregar Nueva Aula</a>
    <hr>
    <div class="table-responsive">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>id</th>
                    <th>Grado</th>
                    <th>Seccion</th>
                    <th>Nivel</th>
                    <th>Vacantes</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aulas as $aula) : ?>
                    <tr class="">
                        <td><?= $aula['id']; ?></td>
                        <td><?= $aula['nombre']; ?></td>
                        <td><?= $aula['seccion']; ?></td>
                        <td><?= $aula['nivel']; ?></td>
                        <td><?= '[ ' . $aula['vacanteTotal'] . '-' . $aula['vacanteRegistrada'] . ' ]'; ?></td>
                        <td>
                            <a href="<?= base_url('editarAula/' . $aula['id']); ?>" class="btn btn-info">Editar</a>
                            <!-- <a href="< ?= base_url('borrarAula/' . $aula['id']); ?>" class="btn btn-danger">Eliminar</a> -->
                            <!-- <button onclick="BloquearAccion()" class="btn btn-info">Editar</button> -->
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
