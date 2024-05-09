<?php

// Conecta a la base de datos
require_once ('conexion.php');

// Abrir el archivo para escritura (si no existe, se creará; si existe, se sobrescribirá)
$archivo_resultado = "resultado.txt";
$file_resultado = fopen($archivo_resultado, 'w');

