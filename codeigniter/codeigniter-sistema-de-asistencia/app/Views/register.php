    <div class="container">
        <h1>Registrarse</h1>
        <h5>Llenar los campos del formulario.</h5>
        <br>
        <form action="<?= base_url('register'); ?>" method="POST">
            <div class="form-group">
                <label for="">Username</label>
                <div class="control">
                    <input type="text" class="form-control" name="username" placeholder="Nombre de usuario">
                </div>
            </div>
            <div class="form-group">
                <label for="">Passowrd</label>
                <input type="password" class="form-control" name="password" placeholder="Contraseña">
            </div>
            <div class="form-group">
                <label for="">DNI</label>
                <input type="text" class="form-control" name="dni" placeholder="Documento de Identidad">
            </div>
            <div class="form-group">
                <label for="">Rol</label>
                <input type="text" class="form-control" name="rol" placeholder="Rol de usuario">
            </div>
            <!--<div class="form-group">
                <label class="">Rol</label>
                <div class="control">
                    <div class="select">
                        <select class="form-control" name="rol">
                            <option disabled selected>Elige un rol</option>
                             <php foreach($roles as $rol): ? >
                                <option value="< ?= $rol['id'] ?>">< ?= $rol['nombre'] ?></option>
                            <php endforeach; ?> 
                        </select>
                    </div>
                </div>-->

                <input type="submit" class="btn btn-primary" value="Registrar">
            </div>

            
        </form>
    </div>