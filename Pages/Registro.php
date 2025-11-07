<?php
require_once("../system/init.php");
session_start();
if (isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit();
}

$mensaje = '';
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cedula = $_POST['inputCedula'];
        $nombre = $_POST['inputNombre'];
        $password = $_POST['inputPassword'];
        $confirmPassword = $_POST['inputConfirmPassword'];

        $queryValidacionCedula = "SELECT id_usuario FROM `usuario` WHERE `cedula` = '$cedula'";
        if (trim($cedula) == '' || trim($nombre) == '' || trim($password) == '' || trim($confirmPassword) == '') {
            $mensaje = 'No debes campos espacios en blanco';
        } else if ($password !== $confirmPassword) {
            $mensaje = 'Las contraseñas no coinciden';
        } else if (strlen($password) < 8) {
            $mensaje = 'La contraseña debe tener al menos 8 caracteres';
        }else if(mysqli_num_rows(mysqli_query($conn, $queryValidacionCedula)) > 0){
            $mensaje = 'La cédula ya está registrada';
        } else {
            $hashPassword = hash("sha256", $password);
            $query = "INSERT INTO `usuario` (`cedula`, `nombre`, `clave`) VALUES ('$cedula', '$nombre', '$hashPassword')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['id_usuario'] = mysqli_insert_id($conn);
                header("Location: index.php");
                exit();
            }
        }
    }
} catch (Exception $e) {
    $mensaje = 'Error al registrar el usuario';
    //log
    error_log($e->getMessage());
}




require_once("layout/authHeader.php");
?>
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Registro</h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-floating mb-3">
                        <input class="form-control" name="inputCedula" id="inputCedula" type="text" placeholder="Número de Cédula" required />
                        <label for="inputCedula">Número de Cédula</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" name="inputNombre" id="inputNombre" type="text" placeholder="Nombre Completo" required />
                        <label for="inputNombre">Nombre Completo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input minlength="8" class="form-control" name="inputPassword" id="inputPassword" type="password" placeholder="Contraseña" required />
                        <label for="inputPassword">Contraseña</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input minlength="8" class="form-control" name="inputConfirmPassword" id="inputConfirmPassword" type="password" placeholder="Confirmar Contraseña" required />
                        <label for="inputConfirmPassword">Confirmar Contraseña</label>
                    </div>
                    <?php
                    if (!empty($mensaje)) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a class="small" href="Login.php">Regresar al Login</a>
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small"><a href="Login.php">¿Ya tienes una cuenta? ¡Inicia sesión!</a></div>
            </div>
        </div>
    </div>
</div>


<?php
require_once("layout/authFooter.php");
?>