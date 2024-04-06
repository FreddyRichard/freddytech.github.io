<div class="col-md-12 p-2">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Id <span style="font-size:12px;"></span></th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Celular</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente) : ?>
                <tr>
                    <td><?= $cliente['id']; ?></td>
                    <td><?= $cliente['nombre']; ?></td>
                    <td><?= $cliente['correo']; ?></td>
                    <td><?= $cliente['celular']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
