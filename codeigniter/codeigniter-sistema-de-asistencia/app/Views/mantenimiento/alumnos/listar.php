<div class="container">

    <h1>Lista de Alumnos</h1>
    <hr>
    <a href="<?= base_url('crearAlumno') ?>" class="btn btn-primary">Agregar Nuevo Alumno</a>
    <hr>

    <div class="table-responsive">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>
                        <a href="<?= site_url('listarAlumnos/id') ?>" id="filtroId" class="filter-link">
                            ID <?php if ($filtroActivo && $orden === 'id'): ?><i class="bi bi-funnel"></i><?php else: ?><i class="bi bi-funnel-fill"></i><?php endif; ?>
                        </a>
                    </th>
                    <th>DNI</th>
                    <th>
                        <a href="<?= site_url('listarAlumnos/nombres') ?>" id="filtroNombres" class="filter-link">
                            Nombres <?php if ($filtroActivo && $orden === 'nombres'): ?><i class="bi bi-funnel-fill"></i><?php else: ?><i class="bi bi-funnel"></i><?php endif; ?>
                        </a>
                    </th>
                    <th>
                        <a href="<?= site_url('listarAlumnos/apellidopaterno') ?>" id="filtroApellidoPaterno" class="filter-link">
                            Apellido Paterno <?php if ($filtroActivo && $orden === 'apellidopaterno'): ?><i class="bi bi-funnel-fill"></i><?php else: ?><i class="bi bi-funnel"></i><?php endif; ?>
                        </a>
                    </th>
                    <th>
                        <a href="<?= site_url('listarAlumnos/apellidomaterno') ?>" id="filtroApellidoMaterno" class="filter-link">
                            Apellido Materno <?php if ($filtroActivo && $orden === 'apellidomaterno'): ?><i class="bi bi-funnel-fill"></i><?php else: ?><i class="bi bi-funnel"></i><?php endif; ?>
                        </a>
                    </th>
                    <th>Grado y Seccion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alumnos as $alumno) : ?>
                    <tr class="">
                        <td><?= $alumno->id; ?></td>
                        <td><?= $alumno->dni; ?></td>
                        <td><?= $alumno->nombres; ?></td>
                        <td><?= $alumno->apellidopaterno; ?></td>
                        <td><?= $alumno->apellidomaterno; ?></td>
                        <td>
                            <?php
                            if ($alumno->aula_id !== null) {
                                echo $aulas[array_search($alumno->aula_id, array_column($aulas, 'id'))]['nombre'] . ' - ' . 
                                    $aulas[array_search($alumno->aula_id, array_column($aulas, 'id'))]['seccion'] . ' - ' . 
                                    $aulas[array_search($alumno->aula_id, array_column($aulas, 'id'))]['nivel'];
                            } else {
                                echo 'N/A'; // Mostrar "No disponible" u otro mensaje que prefieras
                            }
                            ?>
                        </td>
                        <td>
                            <a href="<?= base_url('editarAlumno/' . $alumno->id); ?>" class="btn btn-info">Editar</a>
                            <!-- <a href="< ?= base_url('borrarAlumno/' . $alumno->id); ?>" class="btn btn-danger">Eliminar</a> -->
                            <!-- <button onclick="BloquearAccion()" class="btn btn-info">Editar</button> -->
                            <button onclick="BloquearAccion()" class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>


<script>
    var listarUsuarios = '<?= site_url('listarAlumnos') ?>';
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









    <!-- <script>
        // Esperar a que se cargue el DOM
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener el enlace del filtro de nombres
            var filtroNombres = document.getElementById('filtroNombres');
            // Obtener el enlace del filtro de apellido paterno
            var filtroApellidoPaterno = document.getElementById('filtroApellidoPaterno');
            // Obtener el enlace del filtro de apellido materno
            var filtroApellidoMaterno = document.getElementById('filtroApellidoMaterno');

            // Agregar evento de clic al enlace del filtro de nombres
            filtroNombres.addEventListener('click', function(e) {
                e.preventDefault(); // Prevenir comportamiento predeterminado del enlace

                // Si el filtro no está activo, redirigir a la vista con el filtro activo
                if (!< ?= $filtroActivo ?>) {
                    window.location.href = '< ?= site_url('listarAlumnos/nombres') ?>';
                } else {
                    window.location.href = '< ?= site_url('listarAlumnos') ?>'; // Redirigir a la vista sin filtros
                }
            });

            // Agregar evento de clic al enlace del filtro de Apellido Paterno
            filtroApellidoPaterno.addEventListener('click', function(e) {
                e.preventDefault(); // Prevenir comportamiento predeterminado del enlace

                // Si el filtro no está activo, redirigir a la vista con el filtro activo
                if (!< ?= $filtroActivo ?>) {
                    window.location.href = '< ?= site_url('listarAlumnos/apellidopaterno') ?>';
                } else {
                    window.location.href = '< ?= site_url('listarAlumnos') ?>'; // Redirigir a la vista sin filtros
                }
            });

            // Agregar evento de clic al enlace del filtro de Apellido Materno
            filtroApellidoMaterno.addEventListener('click', function(e) {
                e.preventDefault(); // Prevenir comportamiento predeterminado del enlace

                // Si el filtro no está activo, redirigir a la vista con el filtro activo
                if (!< ?= $filtroActivo ?>) {
                    window.location.href = '< ?= site_url('listarAlumnos/apellidomaterno') ?>';
                } else {
                    window.location.href = '< ?= site_url('listarAlumnos') ?>'; // Redirigir a la vista sin filtros
                }
            });
        });
    </script> -->

