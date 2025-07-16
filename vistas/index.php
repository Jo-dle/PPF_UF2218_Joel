<?php
session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: ./login.php");
    exit;
}

// Cargar XML y XSL una sola vez
$xml = new DOMDocument;
$xml->load("../xml/coches.xml");

$xsl = new DOMDocument;
$xsl->load("../xml/coches.xsl");

$proc = new XSLTProcessor();
$proc->importStyleSheet($xsl);

// Pasar parámetro de rol
$proc->setParameter('', 'rol', $_SESSION['rol']);

// Mostrar mensajes de bienvenida y alertas
echo "Bienvenido, <strong>" . htmlspecialchars($_SESSION['nombre']) . "</strong> (" . htmlspecialchars($_SESSION['rol']) . ")";

// Mensajes
if (isset($_GET["insertado"])) {
    echo "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
        ✅ Coche con matrícula <strong>" . htmlspecialchars($_GET['insertado']) . "</strong> insertado correctamente.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Cerrar'></button>
    </div>";
}

if (isset($_GET["editado"])) {
    echo "
    <div class='alert alert-info alert-dismissible fade show' role='alert'>
        ✏️ Coche con matrícula <strong>" . htmlspecialchars($_GET['editado']) . "</strong> editado correctamente.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Cerrar'></button>
    </div>";
}

if (isset($_GET["eliminado"])) {
    echo "
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
        ✅ Coche con matrícula <strong>" . htmlspecialchars($_GET['eliminado']) . "</strong> eliminado correctamente.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Cerrar'></button>
    </div>";
}

if (isset($_GET["error"]) && $_GET["error"] == "matricula_duplicada") {
    echo "
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        ❌ Error: Ya existe un coche con esa matrícula.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Cerrar'></button>
    </div>";
}


echo <<<HTML
<!-- Botón de logout -->
<a href="../controladores/c.logout.php" class="btn btn-outline-secondary btn-sm">Cerrar sesión</a>

<!-- jQuery y DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#tabla-coches').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
      }
    });
  });
</script>
HTML;
echo "<p>ROL desde sesión: <strong>" . $_SESSION['rol'] . "</strong></p>";

//imprimir el contenido transformado
echo $proc->transformToXML($xml);
?>
