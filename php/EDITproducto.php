<?php
$host = "localhost";
$user = "root";
$pass = "1234";
$db = "mipc5";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Error de conexión: " . $conn->connect_error);

$id = intval($_POST['id']);
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = floatval($_POST['precio']);
$stock = intval($_POST['stock']);
$imagen = $_POST['imagen']; // base64

$sql = $conn->prepare("UPDATE Productos SET Nombre=?, Descripcion=?, Precio=?, Stock=?, Imagen=? WHERE ProductoID=?");
$sql->bind_param("ssdisi", $nombre, $descripcion, $precio, $stock, $imagen, $id);

if ($sql->execute()) {
    echo "Producto actualizado correctamente.";
} else {
    echo "Error al actualizar: " . $sql->error;
}

$conn->close();
?>
