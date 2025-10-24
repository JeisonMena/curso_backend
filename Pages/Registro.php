<?php
require_once("layout/authHeader.php");
?>
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Registro</h3>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputCedula" type="text" placeholder="Número de Cédula" />
                        <label for="inputCedula">Número de Cédula</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputNombre" type="text" placeholder="Nombre Completo" />
                        <label for="inputNombre">Nombre Completo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputPassword" type="password" placeholder="Contraseña" />
                        <label for="inputPassword">Contraseña</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputConfirmPassword" type="password" placeholder="Confirmar Contraseña" />
                        <label for="inputConfirmPassword">Confirmar Contraseña</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <a class="small" href="Login.php">Regresar al Login</a>
                        <a class="btn btn-primary" href="index.html">Registrarse</a>
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