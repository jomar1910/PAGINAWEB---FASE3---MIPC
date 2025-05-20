<?php
$host = "localhost";
$user = "root";
$pass = "1234";
$db = "mipc5";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Error: " . $conn->connect_error);

$id = intval($_GET['id']);

$sql = $conn->prepare("SELECT ProductoID, Nombre, Descripcion, Precio, Stock, Imagen FROM Productos WHERE ProductoID = ?");
$sql->bind_param("i", $id);
$sql->execute();
$result = $sql->get_result();

if ($producto = $result->fetch_assoc()) {
  header('Content-Type: application/json');
  echo json_encode($producto);
} else {
  echo json_encode(null);
}

$conn->close();
?>
