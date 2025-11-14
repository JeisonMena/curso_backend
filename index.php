<?php
require_once 'system/init.php';

?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <h1 class="text-center">Crea tu ticket de soporte</h1>
        <form id="formTicket" onsubmit="saveFormData(); return false;" class="row g-3">
            <div class="col-md-6">
                <label for="inputProblema" class="form-label">Problema</label>
                <input type="texto" class="form-control" id="inputProblema" maxlength="128" placeholder="Titulo del problema...">
            </div>
            <div class="col-md-6">
                <label for="selectPrioridad" class="form-label">Prioridad</label>
                <select id="selectPrioridad" class="form-select">
                    <option value="1" selected>Baja</option>
                    <option value="2">Media</option>
                    <option value="3">Urgente</option>
                </select>
            </div>
            <div class="col-md-12">

                <label for="textDescripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="textDescripcion" rows="3"></textarea>

            </div>
            <div class="col-12">
                <label for="inputImagen" class="form-label">Subir imagen</label>
                <input class="form-control" type="file" id="inputImagen" accept="image/*">
            </div>
            <div class="col-md-6">
                <label for="inputCedula" class="form-label">Cedula</label>
                <input type="texto" class="form-control" id="inputCedula" maxlength="128" placeholder="1-1234-5678">
            </div>
            <div class="col-md-6">
                <label for="inputNombre" class="form-label">Nombre</label>
                <input type="texto" class="form-control" id="inputNombre" maxlength="128" placeholder="Juan Perez...">
            </div>
            <div class="col-md-4">
                <label for="inputTelefono" class="form-label">Telefono</label>
                <input type="text" class="form-control" id="inputTelefono" maxlength="128" placeholder="8888-8888">
            </div>
            <div class="col-md-4">
                <label for="inputCorreo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="inputCorreo" maxlength="128" placeholder="correo@dominio.com">
            </div>
            <div class="col-md-4">
                <label for="selectDepartamento" class="form-label">Departamento</label>
                <select id="selectDepartamento" class="form-select">
                    <?php
                    $queryDepartamentos = mysqli_query($conn, "SELECT id_departamento AS id, nombre FROM departamento");
                    foreach ($queryDepartamentos as $departamento) {
                        echo '<option value="' . $departamento['id'] . '">' . $departamento['nombre'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-12 text-center mt-5">
                <button id="btnEnviarTicket" type="submit" class="btn btn-primary">Enviar Ticket</button>
            </div>
        </form>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="assets/imgs/cargando.gif" alt="Cargando" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>