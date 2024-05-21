<?php

// Conexión a la base de datos
require_once('conexion.php');

// Consulta para obtener el número de registros en folios_descarga
$sql_count_fd = "SELECT COUNT(*) AS count_fd FROM folios_descarga";
$result_count_fd = $conn->query($sql_count_fd);
$row_count_fd = $result_count_fd->fetch_assoc();
$count_fd = $row_count_fd['count_fd'];

// Consulta para obtener el número de registros en xml
$sql_count_xml = "SELECT COUNT(*) AS count_xml FROM xml";
$result_count_xml = $conn->query($sql_count_xml);
$row_count_xml = $result_count_xml->fetch_assoc();
$count_xml = $row_count_xml['count_xml'];

// Imprimir el número de registros de cada tabla
echo "Número de registros en folios_descarga: " . $count_fd . "\n";
echo "Número de registros en xml: " . $count_xml . "\n";

// Consulta para obtener los registros faltantes en xml
$sql_faltantes = "SELECT xml.*
                  FROM xml
                  LEFT JOIN folios_descarga ON xml.nombre = folios_descarga.xml_carpeta
                  WHERE folios_descarga.xml_carpeta IS NULL";

$result_faltantes = $conn->query($sql_faltantes);

// Comprobar si hay resultados
if ($result_faltantes->num_rows > 0) {
    // Abre o crea el archivo CSV
    $csv_file = fopen('resultados_faltantes.csv', 'w');
    // Escribe el encabezado del CSV
    // fputcsv($csv_file, array('ID', 'Nombre'));
    // Itera sobre los resultados y escribe cada fila en el CSV
    while ($row = $result_faltantes->fetch_assoc()) {
        fputcsv($csv_file, $row);
    }
    // Cierra el archivo CSV
    fclose($csv_file);
    echo "Los resultados de los registros faltantes se han guardado en 'resultados_faltantes.csv'.";
} else {
    echo "No se encontraron registros faltantes en xml.";
}

// Cierra la conexión a la base de datos
$conn->close();

?>
