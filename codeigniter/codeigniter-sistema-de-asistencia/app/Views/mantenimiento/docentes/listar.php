<div class="container">
    <h1>Lista de Docentes</h1>
    <hr>
    <a href="<?= base_url('crearDocente') ?>" class="btn btn-primary">Agregar Nuevo Docente</a>
    <a href="<?= base_url('asignarCurso') ?>" class="btn btn-success">Asignar Cursos</a>
    <hr>

    <div class="table-responsive">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="<?= site_url('listarDocentes/id') ?>" id="filtroId" class="filter-link">
                            ID <?php if ($filtroActivo && $orden === 'id'): ?><i class="bi bi-funnel"></i><?php else: ?><i class="bi bi-funnel-fill"></i><?php endif; ?>
                        </a>
                    </th>
                    <th>DNI</th>
                    <th>
                        <a href="<?= site_url('listarDocentes/nombres') ?>" id="filtroNombres" class="filter-link">
                            Docente <?php if ($filtroActivo && $orden === 'nombres'): ?><i class="bi bi-funnel-fill"></i><?php else: ?><i class="bi bi-funnel"></i><?php endif; ?>
                        </a>
                    </th>
                    <th>
                        <a href="<?= site_url('listarDocentes/curso') ?>" id="filtroCurso" class="filter-link">
                            Curso <?php if ($filtroActivo && $orden === 'curso'): ?><i class="bi bi-funnel-fill"></i><?php else: ?><i class="bi bi-funnel"></i><?php endif; ?>
                        </a>
                    </th>
                    <th>Aula</th>
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
                            <?php
                            if ($docente->curso_id !== null) {
                                $cursoId = $docente->curso_id;
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
                            if ($docente->aula_id !== null) {
                                echo $aulas[array_search($docente->aula_id, array_column($aulas, 'id'))]['nombre'] . ' - ' . 
                                    $aulas[array_search($docente->aula_id, array_column($aulas, 'id'))]['seccion'] . ' - ' . 
                                    $aulas[array_search($docente->aula_id, array_column($aulas, 'id'))]['nivel'];
                            } else {
                                echo 'N/A'; // Mostrar "No disponible" u otro mensaje que prefieras
                            }
                            ?>
                        </td>

                        <td>
                            <a href="<?= base_url('editarDocente/' . $docente->id); ?>" class="btn btn-info">Editar</a> 
                            <!-- <a href="< ?= base_url('borrarDocente/' . $docente->id); ?>" class="btn btn-danger">Eliminar</a> -->
                            <!-- <button onclick="BloquearAccion()" class="btn btn-info">Editar</button> -->
                            <button onclick="BloquearAccion()" class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Vista de docentes -->
<script>
    var listarUsuarios = '<?= site_url('listarDocentes') ?>'; // Reutilizar la misma variable
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