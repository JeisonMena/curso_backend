<?php
require_once("layout/headerAuth.php");
?>
<!-- formulario de recuperar contrasena con el correo electronico registrado y el numero de cedula-->
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Recuperar Contraseña</h3>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputEmail" type="email" placeholder="Correo Electrónico" />
                        <label for="inputEmail">Correo Electrónico</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputCedula" type="text" placeholder="Número de Cédula" />
                        <label for="inputCedula">Número de Cédula</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a class="small" href="Login.php">Regresar al Login</a>
                        <a class="btn btn-primary" href="index.html">Recuperar Contraseña</a>
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
require_once("layout/footerAuth.php");
?>