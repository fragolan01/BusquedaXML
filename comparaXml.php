<?php

// conecta a bd bd
require_once ('conexion.php');

// Unos cuantos cambios

// Ruta del archivo de texto
$archivo = "cfdi/todosLosXML.txt";

// Abrir el archivo en modo lectura
$handle = fopen($archivo, "r");

// Verificar si el archivo se abrió correctamente
if ($handle) {
    // Iterar sobre cada línea del archivo
    while (($linea = fgets($handle)) !== false) {
        // Extraer los primeros 36 caracteres de la línea
        $primeros_36_caracteres = substr($linea, 0, 36);
                   
        // Insertando datos en tabla plataforma_ventas_temp
        $sql = "INSERT INTO xml (nombre) VALUES ('$primeros_36_caracteres')";
        
        if ($conn->query($sql) === TRUE) {
            // Si la interceccion fue exitosa  
            $conn->commit();
        echo "Los nombres se han insertado chido.";
        } else {
            // Si falla la inserción en plataforma_ventas_precio, hacer rollback
            $conn->rollback();
            echo "Error al insertar tipo de cambio nombres xml: " . $conn->error;
        }  
        
        
        // Imprimir los +rimeros 36 caracteres de la línea
        echo $primeros_36_caracteres . "\n";
        

    }

    // Cerrar el archivo
    fclose($handle);
    } else {
        // Error al abrir el archivo
        echo "Error al abrir el archivo.";

    }

$directorio = "XMLMAYO2024";

// Obtener la lista de archivos en el directorio
$archivos = scandir($directorio);


// Abrir el archivo para escritura (si no existe, se creará; si existe, se sobrescribirá)
$archivo_resultado = "xml_folder.txt";
$file_handle = fopen($archivo_resultado, 'w');

// Iterar sobre la lista de archivos
foreach ($archivos as $archivo) {
     // Excluir los directorios "." y ".."
     if ($archivo != '.' && $archivo != '..') {
        // Escribir el nombre del archivo en el archivo de resultado
        fwrite($file_handle, $archivo . "\n");

        // Imprimir el nombre del archivo con un salto de línea antes
        echo  $archivo . "\n";
    }

}
// Cerrar el archivo
fclose($file_handle);
echo "Se ha guardado el resultado en el archivo '$archivo_resultado'.";

$file_handle = fopen($archivo_resultado, 'r');

// Verificar si el archivo se abrió corremente
if ($file_handle) {
    // Iterar sobre cada línea del archivo
    while (($lineas = fgets($file_handle)) !== false) {
        // Extraer los primeros 36 caracteres de la línea
        $primeros_36_caracteres = substr($lineas, 0, 36);
                   
        // Insertando datos en tabla plataforma_ventas_temp
        $sql = "INSERT INTO folios_descarga (xml_carpeta) VALUES ('$primeros_36_caracteres')";
        
        if ($conn->query($sql) === TRUE) {
            // Si la interceccion fue exitosa  
            $conn->commit();
        echo "Los Folios se han insertado chido.";
        } else {
            // Si falla la inserción en plataforma_ventas_precio, hacer rollback
            $conn->rollback();
            echo "Error al insertar folios xml: " . $conn->error;
        }  
        
        // Imprimir los primeros 36 caracteres de la línea
        echo $primeros_36_caracteres . "\n";
        
    }

    // Cerrar el archivo
    fclose($file_handle);
    } else {
        // Error al abrir el archivo
        echo "Error al abrir el archivo.";

    }

?>
