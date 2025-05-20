<?php
header('Content-Type: application/json');

$host = "localhost";
$usuario = "root";
$clave = "1234";  // pon aquí tu contraseña si tienes
$bd = "mipc5";

$conn = new mysqli($host, $usuario, $clave, $bd);
if ($conn->connect_error) {
    echo json_encode(['error' => 'Error de conexión a la base de datos']);
    exit;
}

// Consulta las categorías
$sql = "SELECT CategoriaID, Nombre, Descripcion FROM Categorias";
$result = $conn->query($sql);

$categorias = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $categoriaID = $row['CategoriaID'];

        // Consulta las subcategorías para esta categoría
        $sql_sub = "SELECT Nombre, Descripcion FROM Subcategorias WHERE CategoriaID = $categoriaID";
        $res_sub = $conn->query($sql_sub);
        $subcategorias = [];

        if ($res_sub) {
            while ($sub = $res_sub->fetch_assoc()) {
                $subcategorias[] = [
                    'Nombre' => $sub['Nombre'],
                    'Descripcion' => $sub['Descripcion']
                ];
            }
        }

        $categorias[] = [
            'CategoriaID' => $categoriaID,
            'Nombre' => $row['Nombre'],
            'Descripcion' => $row['Descripcion'],
            'Subcategorias' => $subcategorias
        ];
    }
    echo json_encode($categorias);
} else {
    echo json_encode(['error' => 'Error al obtener categorías']);
}

$conn->close();
