<?php
$lines = file("Models/EstudiantesModel.php");
echo "Line 9 hex: " . bin2hex($lines[8]) . "\n";
echo "Line 9 str: " . htmlspecialchars($lines[8]) . "\n";
