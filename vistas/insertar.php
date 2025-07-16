<?php
//Iniciamos la sesión
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: ./index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<!--abrimos la cabezera -->
<head>
  <meta charset="UTF-8">
  <title>Añadir Coche</title>
<!--Link a boostrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Estilos personalizados de la página-->
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
<!-- enviamos la información desde un formulario com metodo "post" a el controlador de insertar en controladores/c.insertar.php-->
<div class="form-container">
  <h1>Añadir Nuevo Coche</h1>
  <form action="../controladores/c.insertar.php" method="post">
    <input type="hidden" name="accion" value="insertar">
    <div class="mb-3">
      <label class="form-label">Matrícula</label>               <!-- Validamos la introducción de los datos-->
      <input type="text" name="matricula" class="form-control" required pattern="\d{4}[A-Z]{3}" placeholder="Ej: 1234ABC" required min="0" max="99999">
    </div>
    <div class="mb-3">
      <label class="form-label">Marca</label>
      <input type="text" name="marca" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Modelo</label>
      <input type="text" name="modelo" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Puertas</label>
      <input type="number" name="puertas" class="form-control" min="2" max="5" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Color</label>
      <input type="text" name="color" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Precio</label>               <!-- Validamos la introducción de los datos-->
      <input type="number" name="precio" class="form-control" required min="0" max="99999">
    </div>
    <div class="mb-3">
      <!-- mostramos las opciones de venta con un menu de "select"-->
      <label class="form-label">Tipo de Venta</label>
      <select name="venta" class="form-select" required>
        <option value="nuevo">Nuevo</option>
        <option value="ocasión">Ocasión</option>
        <option value="segunda mano">Segunda Mano</option>
      </select>
    </div>
    <!-- redireccionamos al index al cancelar o insertar-->
    <button type="submit" class="btn btn-primary btn-space">Insertar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

</body>
</html>
