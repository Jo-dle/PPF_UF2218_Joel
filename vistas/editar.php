<?php
//incluimos los controladores de este archivo
include_once "../controladores/c.editar.php";

?>

<?php
//Iniciamos la sesión
session_start();
if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: ./login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Coche</title>
  <!--Link a bootstrap para aplicar estilo-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Estilos personalizados-->
  <style>
    
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
      background-color: #f8f9fa;
    }
    h1 {
      color: #333366;
    }
    .form-container {
      max-width: 600px;
      margin: auto;
      padding: 20px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0px 0px 10px #ccc;
    }
    .btn-space {
      margin-right: 10px;
    }
  </style>
</head>
<body>
<!--Empezamos el formulario de editar-->
<div class="form-container">
  <h1>Editar Coche</h1>
  <!-- Enviamos el formulario al controlador de editar de manera "post"-->
  <form action="../controladores/c.editar.php" method="post">
    <div class="mb-3">
      <label class="form-label">Matrícula</label>
      <!-- abrimos un php en la matrícula y aplicamos "readonly" para que no se pueda modificar-->
      <input type="text" name="matricula" class="form-control" value="<?php echo $matricula; ?>" readonly>
    </div>
    <div class="mb-3">
      <label class="form-label">Marca</label>
      <input type="text" name="marca" class="form-control" value="<?php echo $marca; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Modelo</label>
      <input type="text" name="modelo" class="form-control" value="<?php echo $modelo; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Puertas</label>
      <!-- volvemos a aplicar la restricción minima de 2 y maxima de 5-->
      <input type="number" name="puertas" class="form-control" min="2" max="5" value="<?php echo $puertas; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Color</label>
      <input type="text" name="color" class="form-control" value="<?php echo $color; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Precio</label>
      <input type="number" name="precio" class="form-control" value="<?php echo $precio; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Tipo de Venta</label>
      <!-- usamos un poco de php para poder cambiar el menú select-->
      <select name="venta" class="form-select">
        <option value="nuevo" <?php if ($venta == "nuevo") echo "selected"; ?>>Nuevo</option>
        <option value="ocasión" <?php if ($venta == "ocasión") echo "selected"; ?>>Ocasión</option>
        <option value="segunda mano" <?php if ($venta == "segunda mano") echo "selected"; ?>>Segunda Mano</option>
      </select>
    </div>
    <!--Botones-->
    <button type="submit" class="btn btn-primary btn-space">Guardar Cambios</button>
    <!-- Al cancelar nos enviamos al index-->
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

