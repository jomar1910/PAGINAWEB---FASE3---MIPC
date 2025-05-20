<?php
$host = "localhost";
$user = "root";
$pass = "1234";
$db = "mipc5";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Error de conexión: " . $conn->connect_error);

$id = intval($_GET['id'] ?? $_POST['id'] ?? 0);

if ($id > 0) {
    $sql = $conn->prepare("DELETE FROM Productos WHERE ProductoID = ?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        echo "Producto eliminado correctamente.";
    } else {
        echo "Error al eliminar: " . $sql->error;
    }
} else {
    echo "ID inválido.";
}

$conn->close();
?>
