<?php
session_start();
if (!isset($_SESSION['rol'])) {
    header("Location: ./login.php");
    exit;
}

$resultados = $_SESSION["resultados_busqueda"] ?? [];
$termino = $_SESSION["termino_busqueda"] ?? "";
unset($_SESSION["resultados_busqueda"], $_SESSION["termino_busqueda"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Coche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="mb-4">Buscar Coche</h1>
    <form action="../controladores/c.buscar_coche.php" method="get" class="mb-4">
        <div class="input-group">
            <input type="text" name="busqueda" class="form-control" placeholder="Buscar por matrícula, marca, modelo o color..." required>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <a href="./index.php" class="btn btn-secondary mb-4">Volver al inicio</a>

   <?php if ($termino !== ""): ?>
    <h4>Resultados para: <em><?= htmlspecialchars($termino) ?></em></h4>

    <?php if (count($resultados) > 0): ?>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Color</th>
                    <th>Puertas</th>
                    <th>Precio</th>
                    <th>Tipo Venta</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultados as $coche): ?>
                    <tr>
                        <td><?= htmlspecialchars($coche["matricula"]) ?></td>
                        <td><?= htmlspecialchars($coche["marca"]) ?></td>
                        <td><?= htmlspecialchars($coche["modelo"]) ?></td>
                        <td><?= htmlspecialchars($coche["color"]) ?></td>
                        <td><?= htmlspecialchars($coche["puertas"]) ?></td>
                        <td><?= htmlspecialchars($coche["precio"]) ?></td>
                        <td><?= htmlspecialchars($coche["venta"]) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning mt-3">No se encontraron resultados.</div>
    <?php endif; ?>
<?php endif; ?>
</div>
</body>
</html>