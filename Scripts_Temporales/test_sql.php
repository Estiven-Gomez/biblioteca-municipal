<?php
require_once "Config/Config.php";
$conn = new mysqli(host, user, pass, db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM estudiante WHERE tipo = 'Estudiante'";
$result = $conn->query($sql);
if (!$result) {
    echo "Error: " . $conn->error;
} else {
    echo "Success!";
}
$conn->close();
