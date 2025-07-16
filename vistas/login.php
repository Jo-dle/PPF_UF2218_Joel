<?php
include_once "../controladores/c.login.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-5">
  <h2 class="mb-4">Iniciar sesión</h2>
  <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">❌ Usuario o contraseña incorrectos.</div>
  <?php endif; ?>

  <form method="POST" action="../controladores/c.login.php">
    <div class="mb-3">
      <label for="correo" class="form-label">Correo:</label>
      <input type="email" name="correo" id="correo" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="contraseña" class="form-label">Contraseña:</label>
      <input type="password" name="contraseña" id="contraseña" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
  </form>
</body>
</html>
<script>
  document.querySelector("form").addEventListener("submit", function(e) {
    const correo = document.getElementById("correo").value.trim();
    const contraseña = document.getElementById("contraseña").value.trim();

    if (!correo || !contraseña) {
      e.preventDefault();
      alert("Rellena todos los campos.");
    }
  });
</script>

