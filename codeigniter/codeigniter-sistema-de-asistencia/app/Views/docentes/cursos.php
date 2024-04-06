<div class="container">
    <h1>Cursos asignados</h1>
    <hr>

    <div class="table-responsive">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>CURSO</th>
                    <th>AULA</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($docentes as $docente) : ?>
                    <tr class="">
                        <td><?= $docente['id']; ?></td>
                        <td>
                            <?php
                            if ($docente['curso_id'] !== null) {
                                $cursoId = $docente['curso_id'];
                                $nombreCurso = '';
                                foreach ($cursos as $curso) {
                                    if ($curso['id'] == $cursoId) {
                                        $nombreCurso = $curso['nombre'];
                                        break;
                                    }
                                }
                                echo $nombreCurso;
                            } else {
                                echo 'N/A'; // Mostrar "No disponible" u otro mensaje que prefieras
                            }
                            ?>
                        </td>

                        <td>
                            <?php
                            if ($docente['aula_id'] !== null) {
                                echo $aulas[array_search($docente['aula_id'], array_column($aulas, 'id'))]['nombre'] . ' - ' . 
                                    $aulas[array_search($docente['aula_id'], array_column($aulas, 'id'))]['seccion'] . ' - ' . 
                                    $aulas[array_search($docente['aula_id'], array_column($aulas, 'id'))]['nivel'];
                            } else {
                                echo 'N/A'; // Mostrar "No disponible" u otro mensaje que prefieras
                            }
                            ?>
                        </td>

                        <td>
                            <a href="<?= base_url('crearAsistencias/' . $docente['id']); ?>" class="btn btn-warning">Asistencias</a>
                            <a href="<?= base_url('crearAsignacionCurso/' . $docente['id']); ?>" class="btn btn-success">Notas</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>