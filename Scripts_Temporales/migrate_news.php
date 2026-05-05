<?php
require_once "Config/Config.php";
$conn = new mysqli(host, user, pass, db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS noticias (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    contenido TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado TINYINT(1) DEFAULT 1
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla 'noticias' creada exitosamente.<br>";
} else {
    echo "Error creando la tabla: " . $conn->error . "<br>";
}

$conn->close();
