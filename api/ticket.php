<?php 
header('Content-Type: application/json');
require_once '../system/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recibir datos del formulario enviado por fetch
    $problema = $_POST['problema'] ?? '';
    $prioridad = $_POST['prioridad'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $cedula = $_POST['cedula'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $departamento = $_POST['departamento'] ?? '';
    
    // Manejar archivo de imagen
    $imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
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
    (NULL, '$problema', '$descripcion', '$prioridad', '$imagen', '$nombre', '$cedula', '$telefono', '$correo', '$departamento', NOW(), NULL, '0', NULL)";
    
    $result = mysqli_query($conn, $sql_insert);
    
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Ticket creado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear el ticket']);
    }

}