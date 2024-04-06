    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mt-5">Inicio de sesión</h2>
                <form action="<?= base_url('login'); ?>" method="POST">
                    <div class="form-group">
                        <label for="text">Correo electrónico:</label>
                        <input type="text" class="form-control" id="text" name="username" placeholder="Ingrese su correo electrónico" required>
                    </div>
                    <?php if(isset($errors['username'])): ?>
                        <p><?php echo $errors['username']; ?></p>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                    </div>
                    <?php if(isset($errors['password'])): ?>
                        <p><?php echo $errors['password']; ?></p>
                    <?php endif; ?>
                    
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </form>

                <?php if ($error = session('error')): ?>
                    <p><?php echo $error; ?></p>
                <?php endif; ?>

            </div>
        </div>
    </div>


                    <br>

<div class="container-users">
        <div class="grid-container">
            <!-- <div class="icono">
                <img src="uploads/Admin.png" alt="">
                <h7><span class="user-title">Usuario:</span> <span class="admin-name">admin</span></h7>
                <h7><span class="user-title">Password:</span> <span class="admin-name">123</span></h7>
            </div> -->
            <div class="icono">
                <img src="uploads/Oficina.png" alt="">
                <h7><span class="user-title">Usuario:</span> <span class="admin-name">oficina</span></h7>
                <h7><span class="user-title">Password:</span> <span class="admin-name">123</span></h7>
            </div>
            <div class="icono">
                <img src="uploads/Profesor.png" alt="">
                <h7><span class="user-title">Usuario:</span> <span class="admin-name">docente</span></h7>
                <h7><span class="user-title">Password:</span> <span class="admin-name">123</span></h7>
            </div>
            <div class="icono">
                <img src="uploads/Alumnos.png" alt="">
                <h7><span class="user-title">Usuario:</span> <span class="admin-name">alumno</span></h7>
                <h7><span class="user-title">Password:</span> <span class="admin-name">123</span></h7>
            </div>
        </div>
    </div>

    <style>
        .container-users {
            display: flex;
            justify-content: center;
            /* align-items: center; */
            height: 30vh;
            /* background-color: yellow; */
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 40px;
        }

        .icono {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 180px;
            height: 280px;
            /* background-color: red; */
            border: 5px solid #1983D7;
            border-radius: 10px;
        }
        .icono img {
            max-width: 100%;
            max-height: 100%;
        }
        .user-title {
            font-weight: bold;
        }
        .admin-name {
            font-size: 1rem;
        }

        @media (max-width: 900px){
            .grid-container {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                grid-gap: 20px;
            }

            .icono {
                width: 100px;
                height: 160px;
                border: 2px solid yellow;
                border-radius: 10px;
                /* background-color: green; */
            }
            .user-title {
                font-size: 10px;
            }
            .admin-name {
                font-size: 10px;
            }
        }
    </style>