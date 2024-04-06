<?= $header; ?>

<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-0.5">
            <form action="<?= site_url('/actualizar') ?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $curso['id'] ?>">

                <div class="form-group">
                    <label for="nombre">Nombre<span class="required"> *</span></label>
                    <input type="text" class="form-control" name="nombre" value="<?= $curso['nombre']; ?>">
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" value="<?= $curso['descripcion']; ?>">
                </div>

                <div class="form-group">
                    <label for="categoria">Categoria<span class="required"> *</span></label>
                    <input type="text" class="form-control" name="categoria" value="<?= $curso['categoria']; ?>">
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <br/>
                    <img src="<?= base_url() ?>/uploads/<?= $curso['imagen']; ?>" class="img-thumbnail" width="100" alt="">
                    <input id="imagen" class="form-control-file" type="file" name="imagen">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="<?= base_url('listar'); ?>" class="btn btn-info" >Regresar</a>
            </form>
        </div>
    </div>
</div>


<?= $footer ?>