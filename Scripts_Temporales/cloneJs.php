<?php
$js = file_get_contents('Assets/js/funciones.js');

// Extract the Estudiantes block (roughly from line 302 to 415)
// Actually we can just do a regex or string extraction if we know the exact string.
// Instead, I'll use regex to grab the block between `//Fin Usuarios` and `//Fin Estudiante`
preg_match("/\/\/Fin Usuarios(.*)\/\/Fin Estudiante/s", $js, $matches);
$estBlock = $matches[1];

// Function to generate and append replacement block
function appendJS($block, $source, $target, $tblSource, $tblTarget, $btnS, $btnT) {
    $newBlock = str_replace($source, $target, $block);
    $newBlock = str_replace(strtolower($source), strtolower($target), $newBlock);
    $newBlock = str_replace('frmEstudiante', 'frm' . $target, $newBlock);
    $newBlock = str_replace($tblSource, $tblTarget, $newBlock);
    $newBlock = str_replace('btnEditar'.$btnS, 'btnEditar'.$btnT, $newBlock);
    $newBlock = str_replace('btnEliminar'.$btnS, 'btnEliminar'.$btnT, $newBlock);
    $newBlock = str_replace('btnReingresar'.$btnS, 'btnReingresar'.$btnT, $newBlock);
    $newBlock = str_replace('nuevoEstudiante', 'nuevo' . $target, $newBlock);
    $newBlock = str_replace('registrarEstudiante', 'registrar' . $target, $newBlock);
    return $newBlock . "\n//Fin " . $target . "\n";
}

$profBlock = appendJS($estBlock, 'Estudiantes', 'Profesores', 'tblEst', 'tblProfesores', 'Est', 'Pro');
$perBlock = appendJS($estBlock, 'Estudiantes', 'Personas', 'tblEst', 'tblPersonas', 'Est', 'Per');

$js .= "\n" . $profBlock . "\n" . $perBlock;

file_put_contents('Assets/js/funciones.js', $js);
echo "JS Cloned Successfully.";
