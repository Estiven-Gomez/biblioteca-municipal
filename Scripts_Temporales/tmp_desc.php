<?php
require_once "Config/Config.php";
$conn = new mysqli(host, user, pass, db);
$result = $conn->query("DESCRIBE estudiante");
$data = [];
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
$conn->close();
