<?php
require_once("../system/config.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedulaIngresada'];
    $password = $_POST['passIngresada'];

    $query = "SELECT * FROM `usuario` WHERE cedula = '".$cedula."'";

 var_dump($query);
}




require_once("layout/AuthHeader.php");
?>
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Login</h3>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-floating mb-3">
                        <input name="cedulaIngresada" class="form-control" id="inputCedula" type="text" placeholder="1234567"/>
                        <label for="inputCedula">Cedula</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="passIngresada" class="form-control" id="inputPassword" type="password" placeholder="Password" />
                        <label for="inputPassword">Clave</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a class="small" href="RecuperarContrasena.php">¿Recuperar Contraseña?</a>
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small"><a href="Registro.php">¿No tienes una cuenta? ¡Regístrate!</a></div>
            </div>
        </div>
    </div>
</div>
<?php
require_once("layout/authFooter.php");
?>