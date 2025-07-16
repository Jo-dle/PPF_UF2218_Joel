<?php
session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: ../vistas/login.php");
    exit;
}

$xml = new DOMDocument();
$xml->load("../xml/coches.xml");

$resultados = [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["busqueda"]) && $_GET["busqueda"] !== "") {
    $busqueda = strtolower(trim($_GET["busqueda"]));
    $coches = $xml->getElementsByTagName("coche");

    foreach ($coches as $coche) {
        $matricula = $coche->getAttribute("matricula");
        $marca = $coche->getElementsByTagName("marca")[0]->nodeValue;
        $modelo = $coche->getElementsByTagName("modelo")[0]->nodeValue;
        $color = $coche->getElementsByTagName("color")[0]->nodeValue;

        if (
            strpos(strtolower($matricula), $busqueda) !== false ||
            strpos(strtolower($marca), $busqueda) !== false ||
            strpos(strtolower($modelo), $busqueda) !== false ||
            strpos(strtolower($color), $busqueda) !== false
        ) {
            // Guardamos los datos del coche como array simple
            $resultados[] = [
                "matricula" => $matricula,
                "marca" => $marca,
                "modelo" => $modelo,
                "color" => $color,
                "puertas" => $coche->getElementsByTagName("puertas")[0]->nodeValue,
                "precio" => $coche->getElementsByTagName("precio")[0]->nodeValue,
                "venta" => $coche->getElementsByTagName("precio")[0]->getAttribute("venta")
            ];
        }
    }

    $_SESSION["resultados_busqueda"] = $resultados;
    $_SESSION["termino_busqueda"] = $_GET["busqueda"];
    header("Location: ../vistas/buscar_coche.php");
    exit;
} else {
    header("Location: ../vistas/buscar_coche.php");
    exit;
}
