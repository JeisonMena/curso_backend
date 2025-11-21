<?php
require_once("../system/session.php");
require_once("layout/header.php");

// Consultar tickets pendientes
$query = "SELECT t.*, d.nombre as departamento_nombre 
          FROM ticket t 
          LEFT JOIN departamento d ON t.id_departamento = d.id_departamento 
          WHERE t.estado = 0 
          ORDER BY t.prioridad DESC, t.fecha DESC";
$result = mysqli_query($conn, $query);



$mensaje = [];
if (isset($_GET['resolver']) && isset($_GET['token']) && $_GET['token'] === $_SESSION['token']) {
    $id_ticket = intval($_GET['resolver']);
    $queryTicket = mysqli_query($conn, "SELECT id_ticket FROM ticket WHERE id_ticket = $id_ticket AND estado = 0");
    if(mysqli_num_rows($queryTicket) > 0) {
        $fecha_actual = date('Y-m-d H:i:s');
    
        $update_query = "UPDATE ticket SET estado = 1, fecha_finalizado = '$fecha_actual' WHERE id_ticket = $id_ticket";
        mysqli_query($conn, $update_query);
    
        if (mysqli_affected_rows($conn) > 0) {
            $mensaje['success'] = true;
            $mensaje['texto'] = "Ticket marcado como resuelto exitosamente.";
        } else {
            $mensaje['success'] = false;
            $mensaje['texto'] = "Error al marcar el ticket como resuelto.";
        }
    }else{
        $mensaje['success'] = false;
        $mensaje['texto'] = "El ticket no existe o ya ha sido resuelto.";
    }
}

$_SESSION['token'] = bin2hex(random_bytes(32));
?>

<div class="container mt-4">
    <h2>Tickets Pendientes</h2>
    <?php
    if(!empty($mensaje)) {
        if($mensaje['success']) {
            echo '<div class="alert alert-success">' . $mensaje['texto'] . '</div>';
        } else {
            echo '<div class="alert alert-danger">' . $mensaje['texto'] . '</div>';
        }
    }
    ?>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="row">
            <?php foreach ($result as $ticket) { ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <?php
                        $imagen = '../assets/imgs/default.png';
                        if (isset($ticket['url_imagen'])) {
                            if (str_contains($ticket['url_imagen'], 'http')) {
                                $imagen = $ticket['url_imagen'];
                            } else {
                                if (file_exists("../uploads/imgs/" . $ticket['url_imagen'])) {
                                    $imagen = "../uploads/imgs/" . $ticket['url_imagen'];
                                }
                            }
                        }
                        ?>
                        <img src="<?= $imagen ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Imagen del ticket">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo ($ticket['titulo']); ?></h5>
                            <p class="card-text"><?php echo ($ticket['descripcion']); ?></p>

                            <div class="mb-2">
                                <?php
                                $prioridad_class = '';
                                $prioridad_text = '';
                                switch ($ticket['prioridad']) {
                                    case 1:
                                        $prioridad_class = 'bg-success';
                                        $prioridad_text = 'Baja';
                                        break;
                                    case 2:
                                        $prioridad_class = 'bg-warning';
                                        $prioridad_text = 'Media';
                                        break;
                                    case 3:
                                        $prioridad_class = 'bg-danger';
                                        $prioridad_text = 'Urgente';
                                        break;
                                }
                                ?>
                                <span class="badge <?php echo $prioridad_class; ?>">
                                    Prioridad: <?php echo $prioridad_text; ?>
                                </span>
                            </div>

                            <div class="small text-muted">
                                <p><strong>Solicitante:</strong> <?php echo ($ticket['nombre']); ?></p>
                                <p><strong>Cédula:</strong> <?php echo ($ticket['cedula']); ?></p>
                                <p><strong>Teléfono:</strong> <?php echo ($ticket['telefono']); ?></p>
                                <p><strong>Correo:</strong> <?php echo ($ticket['correo']); ?></p>
                                <p><strong>Departamento:</strong> <?php echo ($ticket['departamento_nombre']); ?></p>
                                <p><strong>Fecha:</strong> <?php echo date('d/m/Y g:ia', strtotime($ticket['fecha'])); ?></p>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary btn-sm" onclick="asignarTicket(<?= $ticket['id_ticket']; ?>)">
                                    Asignar
                                </button>
                                <button class="btn btn-success btn-sm" onclick="resolverTicket(<?php echo $ticket['id_ticket']; ?>)">
                                    Marcar como Resuelto
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            <h4>No hay tickets pendientes</h4>
            <p>Todos los tickets han sido procesados.</p>
        </div>
    <?php endif; ?>
</div>

<script>
    function asignarTicket(id) {
        if (confirm('¿Desea asignar este ticket?')) {
            window.location.href = 'asignar_ticket.php?id=' + id;
        }
    }

    function resolverTicket(id) {
        if (confirm('¿Está seguro de marcar este ticket como resuelto?')) {
            window.location.href = '?resolver=' + id+"&token=<?=$_SESSION['token']?>";
        }
    }
</script>

<?php
require_once("layout/footer.php");
?>