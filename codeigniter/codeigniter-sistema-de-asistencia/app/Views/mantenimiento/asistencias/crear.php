<div class="container">

    <h1>Lista de Alumnos - <?= $aulaData['nombre'] . ' ' . $aulaData['seccion'] . ' - ' . $aulaData['nivel']; ?></h1>
    <hr>
    
    <form action="<?= base_url('guardarAsistencia/' . $docenteData['id']); ?>" method="post">

        <a href="<?= base_url('docente/cursos') ?>" class="btn btn-info">Regresar</a>
        <button type="submit" class="btn btn-success">Guardar Asistencias</button>

        <div class="input-group">
            <input type="text" class="form-control" name="fecha_asistencia" placeholder="Formato: YYYY-MM-DD">
        </div>

        <hr>
        <div class="table-responsive">
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>id</th>
                        <th>Alumno</th>
                        <th>Asistencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alumnos as $alumno) : ?>
                        <tr class="">
                            <td><?= $alumno['id']; ?></td>
                            <td>
                                <?php
                                if ($alumno['usuario_id'] !== null) {
                                    echo $usuarios[array_search($alumno['usuario_id'], array_column($usuarios, 'id'))]->nombres . ' ' . 
                                        $usuarios[array_search($alumno['usuario_id'], array_column($usuarios, 'id'))]->apellidopaterno . ' ' . 
                                        $usuarios[array_search($alumno['usuario_id'], array_column($usuarios, 'id'))]->apellidomaterno;
                                } else {
                                    echo 'N/A'; // Mostrar "No disponible" u otro mensaje que prefieras
                                }
                                ?>
                            </td>

                            <td>
                                <select name="asistencias[<?= $alumno['id']; ?>]">
                                    <option value="">Seleccionar estado</option>
                                    <option value="Presente">Presente</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Falta">Falta</option>
                                </select>
                            </td>

                            <!-- <td>< ?= $alumno['nombres']; ?></td> -->
                            <td>
                                <!-- Aquí puedes agregar el código para la asistencia del alumno si es necesario -->
                            </td>
                            <td>
                                <!-- Acciones para cada alumno -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </form>

</div>