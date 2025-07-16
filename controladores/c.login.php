<?php
//Iniciamos las sesión
session_start();
//Traemos los datos de correo y contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $xml = simplexml_load_file("../xml/usuarios.xml");

    foreach ($xml->usuario as $usuario) {
        if (
            //Aseguramos la contraseña y el email
           trim(strtolower($usuario->correo)) === trim(strtolower($correo)) &&
            trim($usuario->contraseña) === trim($contraseña)
        ) {
            $_SESSION['nombre'] = (string)$usuario->nombre;
            $_SESSION['rol'] = (string)$usuario->rol;

            header("Location: ../vistas/index.php");
            exit;
        }
    }

    // Si no se encontró ningún usuario válido
    header("Location: ../vistas/login.php?error=1");
    exit;
}
?>
