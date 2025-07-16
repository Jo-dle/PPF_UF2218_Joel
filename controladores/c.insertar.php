<?php
//Iniciamos la sesión
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] !== "administrador") {
    // Redirigir o mostrar mensaje de acceso denegado
    header("Location: ../vistas/index.php");
    exit();
}

// Abrimos php y llamamos al documento xml para cargar los datos
$xml = new DOMDocument();
$xml->load("../xml/coches.xml");
// Buscamos la matricula y se la aplicamos a coche
$matricula = $_POST["matricula"];
$coches = $xml->getElementsByTagName("coche");

// Verificar si ya existe la matrícula
foreach ($coches as $coche) {
    if ($coche->getAttribute("matricula") === $matricula) {
        header("Location: ../vistas/index.php?error=matricula_duplicada");
        exit();
    }
}

// Creamos un nuevo coche
$nuevo = $xml->createElement("coche");
$nuevo->setAttribute("matricula", $matricula);
$nuevo->appendChild($xml->createElement("marca", $_POST["marca"]));
$nuevo->appendChild($xml->createElement("modelo", $_POST["modelo"]));
$nuevo->appendChild($xml->createElement("puertas", $_POST["puertas"]));
$nuevo->appendChild($xml->createElement("color", $_POST["color"]));

$precio = $xml->createElement("precio", $_POST["precio"]);
$precio->setAttribute("venta", $_POST["venta"]);
$nuevo->appendChild($precio);
//Afirmamos la creación de un nuevo campo en la tabla de coches
$xml->documentElement->appendChild($nuevo);
//Guardamos el nuevo insert en el documento base
$xml->save("../xml/coches.xml");
//Nos reenviamos al insert y nos llevamos la matricula del coche nuevo para plasmar el mensaje
header("Location: ../vistas/index.php?insertado=" . urlencode($matricula));
exit();
