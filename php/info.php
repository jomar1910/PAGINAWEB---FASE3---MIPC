<?php
$host = "localhost";
$usuario = "root";
$clave = "1234";
$bd = "mipc5";

$conn = new mysqli($host, $usuario, $clave, $bd);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "¡Conectado correctamente a la base de datos mipc5!";
}

$conn->close();
?>
