<?php
include("connect.php");
$connection = Conectar();

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$comentario = $_POST['poc'];

$stmt = $connection->prepare("INSERT INTO ayuda (nombre, correo, poc) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $correo, $comentario);


if ($stmt->execute()) {
    echo "Datos insertados correctamente.";
} else {
    echo "Error al insertar: " . $stmt->error;
}

$stmt->close();
$connection->close();
?>
