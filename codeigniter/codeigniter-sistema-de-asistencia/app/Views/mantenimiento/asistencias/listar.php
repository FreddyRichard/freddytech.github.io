<div class="container">

    <h1>Lista de asistencias</h1>
    <hr>
    <a href="<?= base_url('docente/cursos') ?>" class="btn btn-primary">Agregar Nuevas Asistencia</a>
    <hr>

    <!-- Formulario de filtrado por fecha -->
    <form action="<?= base_url('listarAsistenciasPorFecha') ?>" method="get">
        <div class="form-group">
            <label for="fecha">Filtrar por fecha:</label>
            <input type="date" id="fecha" name="fecha" class="form-control">
        </div>
        <button type="submit" class="btn btn-info">Filtrar</button>
    </form>

    <hr>

    <div class="table-responsive">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>id</th>
                    <th>Alumno</th>
                    <th>Curso</th>
                    <th>Aula</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($asistencias as $asistencia) : ?>
                    <tr class="">
                        <td><?= $asistencia['id']; ?></td>
                        <!-- <td>< ?= $asistencia['usuario_id']; ?></td> -->
                        <td>
                            <?php
                            $usuarioId = $asistencia['usuario_id'];
                            $nombreUsuario = '';
                            foreach ($usuarios as $usuario) {
                                if ($usuarioId == $usuario->id) { // Compara con el id del usuario, no con el id de asistencia
                                    $nombreUsuario = $usuario->nombres;
                                    $apellidoPaterno = $usuario->apellidopaterno;
                                    $apellidoMaterno = $usuario->apellidomaterno;
                                    break;
                                }
                            }
                            echo $nombreUsuario .' '. $apellidoPaterno .' '. $apellidoMaterno;
                            ?>
                        </td>
                        <td><?= $asistencia['curso_id']; ?></td>
                        <td><?= $asistencia['aula_id']; ?></td>
                        <td><?= $asistencia['fecha']; ?></td>
                        <td><?= $asistencia['estado']; ?></td>

                        <td>
                            <a href="<?= base_url('editarasistencia/' . $asistencia['id']); ?>" class="btn btn-info">Editar</a>
                            <!-- <a href="< ?= base_url('borrarasistencia/' . $asistencia['id']); ?>" class="btn btn-danger">Eliminar</a> -->
                            <!-- <button onclick="BloquearAccion()" class="btn btn-info">Editar</button>   -->
                            <button onclick="BloquearAccion()" class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>



