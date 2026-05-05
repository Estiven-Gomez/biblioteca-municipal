<?php
require_once "Config/Config.php";
$conn = new mysqli(host, user, pass, db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add 'tipo'
$sql1 = "ALTER TABLE estudiante ADD COLUMN tipo VARCHAR(50) DEFAULT 'Estudiante'";
if ($conn->query($sql1) === TRUE) {
    echo "Columna 'tipo' agregada exitosamente.<br>";
} else {
    echo "Error agregando 'tipo': " . $conn->error . "<br>";
}

// Add 'usuario_id'
$sql2 = "ALTER TABLE estudiante ADD COLUMN usuario_id INT DEFAULT NULL";
if ($conn->query($sql2) === TRUE) {
    echo "Columna 'usuario_id' agregada exitosamente.<br>";
} else {
    echo "Error agregando 'usuario_id': " . $conn->error . "<br>";
}

$conn->close();
