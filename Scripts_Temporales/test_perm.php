<?php
require_once "Config/Config.php";
$conn = new mysqli(host, user, pass, db);
$res = $conn->query("SELECT * FROM permisos");
$p = [];
while($r = $res->fetch_assoc()) $p[] = $r;
echo json_encode($p);
