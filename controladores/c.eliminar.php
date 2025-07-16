<?php

//si no hay matricula en el campo no podemos borrar
if (!isset($_GET["matricula"])) {
    die("⚠️ Error: Matrícula no especificada.");
}
//Recogemos la matricula del xml
$matricula = $_GET["matricula"];
$archivoXML = "../xml/coches.xml";
//Si no existe el archivo xml cancelamos operación
if (!file_exists($archivoXML)) {
    die("📁 Error: No se encuentra el archivo XML.");
}
//Cargamos el archivo xml
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->formatOutput = true;
$xml->load($archivoXML);

$coches = $xml->getElementsByTagName("coche");
$encontrado = false;
//verificamos la matrícula
foreach ($coches as $coche) {
    if ($coche->getAttribute("matricula") === $matricula) {
        // Doble verificación de existencia
        if ($coche->parentNode !== null) {
            $coche->parentNode->removeChild($coche);
            $encontrado = true;
        }
        break;
    }
}
//Si se encuentra un coche con matrícula borramos guardamos el archivo y nos reenviamos a index con la matricula eliminada para plasmar un mensaje
if ($encontrado) {
    if ($xml->save($archivoXML)) {
        header("Location: ../vistas/index.php?eliminado=" . urlencode($matricula));
        exit();
        //Si no se cumple lo anterior mandamos un echo con un error
    } else {
        echo "💾 Error al guardar el archivo XML después de eliminar.";
    }
    //En caso de que no se cumpla ninguna de las anteriores reglas debe ser porque no hay coche con esa matrícula y plasmamo el mensaje
} else {
    echo "🚫 Error: Coche con matrícula '$matricula' no encontrado o ya fue eliminado.";
}
?>
