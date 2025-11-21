<?php
header('Content-Type: application/json');
require_once '../system/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recibir datos del formulario enviado por fetch

    if (!isset($_POST['problema'])) {
        $problema = '';
    } else {
        $problema = mysqli_real_escape_string($conn, $_POST['problema']);
    }


    $prioridad = (int)$_POST['prioridad'];

    if (!isset($_POST['descripcion'])) {
        $descripcion = '';
    } else {
        $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
        $descripcion = htmlspecialchars($descripcion);
    }

    if (!isset($_POST['cedula'])) {
        $cedula = '';
    } else {
        $cedula = mysqli_real_escape_string($conn, $_POST['cedula']);
    }

    if (!isset($_POST['nombre'])) {
        $nombre = '';
    } else {
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    }

    if (!isset($_POST['telefono'])) {
        $telefono = '';
    } else {
        $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    }

    if (!isset($_POST['correo'])) {
        $correo = '';
    } else {
        $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    }


    $departamento = (int)$_POST['departamento'];


    // Manejar archivo de imagen
    $arrImagenesAcceptadas = ['jpeg', 'png', 'gif'];
    $imagen = null;

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK && in_array(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION), $arrImagenesAcceptadas)) {
        $upload_dir = '../uploads/imgs/';
        $file_extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $file_extension;
        $upload_path = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $upload_path)) {
            $imagen = $filename;
        }
    }

    // Validar datos requeridos
    if (empty($problema) || empty($prioridad) || empty($descripcion) || empty($cedula) || empty($nombre)) {
        echo json_encode(['success' => false, 'message' => 'Faltan campos requeridos']);
        exit;
    }

    $sql_insert = "INSERT INTO `ticket` (`id_ticket`, `titulo`, `descripcion`, `prioridad`, `url_imagen`, `nombre`, `cedula`, `telefono`, `correo`, `id_departamento`, `fecha`, `id_usuario_asignado`, `estado`, `fecha_finalizado`)
    VALUES
    (NULL, '$problema', '$descripcion', '$prioridad', " . (is_null($imagen) ? 'NULL' : "'$imagen'") . ", '$nombre', '$cedula', '$telefono', '$correo', '$departamento', NOW(), NULL, '0', NULL)";

    $result = mysqli_query($conn, $sql_insert);

    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Ticket creado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear el ticket']);
    }
}
