<?php
//Iniciamos la sesión
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] !== "administrador") {
    // Redirigir o mostrar mensaje de acceso denegado
    header("Location: index.php");
    exit();
}

//Cargamos el documento
$xml = new DOMDocument();
$xml->load("../xml/coches.xml");

// Obtener la matrícula
$matricula = $_REQUEST["matricula"] ?? null;

$coches = $xml->getElementsByTagName("coche");

// Preparamos el formualrio para editar
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($coches as $coche) {
        if ($coche->getAttribute("matricula") === $matricula) {
            $coche->getElementsByTagName("marca")[0]->nodeValue = $_POST["marca"];
            $coche->getElementsByTagName("modelo")[0]->nodeValue = $_POST["modelo"];
            $coche->getElementsByTagName("puertas")[0]->nodeValue = $_POST["puertas"];
            $coche->getElementsByTagName("color")[0]->nodeValue = $_POST["color"];
            $precio = $coche->getElementsByTagName("precio")[0];
            $precio->nodeValue = $_POST["precio"];
            $precio->setAttribute("venta", $_POST["venta"]);
            $xml->save("../xml/coches.xml");
            //Nos redirecionamos una vez guardado al index con la matricula del coche modificado para plasmar un mensaje
            header("Location: ../vistas/index.php?editado=" . urlencode($matricula));
            exit();
        }
    }
//En caso de que no se cumpla lo anterior mandamos la url no_encontrado para plasmar el error en el index
    header("Location: ../vistas/index.php?error=no_encontrado");
    exit();
}

//Cogemos los datos y los ponemos en el formulario de antes
foreach ($coches as $coche) {
    if ($coche->getAttribute("matricula") === $matricula) {
        $marca = $coche->getElementsByTagName("marca")[0]->nodeValue;
        $modelo = $coche->getElementsByTagName("modelo")[0]->nodeValue;
        $puertas = $coche->getElementsByTagName("puertas")[0]->nodeValue;
        $color = $coche->getElementsByTagName("color")[0]->nodeValue;
        $precio = $coche->getElementsByTagName("precio")[0]->nodeValue;
        $venta = $coche->getElementsByTagName("precio")[0]->getAttribute("venta");
        break;
    }
}
