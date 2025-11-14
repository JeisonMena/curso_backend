<?php
require_once 'system/init.php';
// Handle form submissions
if ($_POST) {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'create':
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            mysqli_query($conn, "INSERT INTO agenda (nombre, telefono) VALUES ('$nombre', '$telefono')");
            break;

        case 'update':
            $id = (int)$_POST['id'];
            $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
            $telefono = $_POST['telefono'];
            mysqli_query($conn, "UPDATE agenda SET nombre = '$nombre', telefono = '$telefono' WHERE id = $id");
            break;

        case 'delete':
            $id = (int)$_POST['id'];
            mysqli_query($conn, "DELETE FROM agenda WHERE id = $id");
            break;
    }
}

// Read data
$result = mysqli_query($conn, "SELECT id, nombre, telefono FROM agenda");
$contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>CRUD Agenda</title>
</head>

<body>
    <h2>Create Contact</h2>
    <form method="POST">
        <input type="hidden" name="action" value="create">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="telefono" placeholder="Teléfono" required>
        <button type="submit">Create</button>
    </form>

    <h2>Contacts</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <form method="POST" style="display:inline;">
                    <td><?= $contact['id'] ?></td>
                    <td><input type="text" name="nombre" value="<?= htmlspecialchars($contact['nombre']) ?>"></td>
                    <td><input type="text" name="telefono" value="<?= htmlspecialchars($contact['telefono']) ?>"></td>
                    <td>
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" value="<?= $contact['id'] ?>">
                        <button type="submit">Update</button>
                    </td>
                </form>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $contact['id'] ?>">
                        <button type="submit" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>