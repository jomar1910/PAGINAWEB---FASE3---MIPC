<?php
$host = "localhost";
$usuario = "root";
$clave = "1234";
$bd = "mipc5";

$conn = new mysqli($host, $usuario, $clave, $bd);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$categoriaID = $_POST['categoriaID'] ?? 0;
$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$precio = $_POST['precio'] ?? 0;
$stock = $_POST['stock'] ?? 0;
$imagen = $_POST['imagen'] ?? '';

if ($categoriaID == 0 || empty($nombre) || empty($descripcion) || empty($imagen)) {
    echo "Faltan datos obligatorios o categoría no válida.";
    exit;
}

$stmt = $conn->prepare("INSERT INTO Productos (CategoriaID, Nombre, Descripcion, Precio, Stock, Imagen) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issdis", $categoriaID, $nombre, $descripcion, $precio, $stock, $imagen);

if ($stmt->execute()) {
    echo "Producto agregado exitosamente.";
} else {
    echo "Error al agregar producto: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
