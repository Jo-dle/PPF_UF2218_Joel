<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html" encoding="UTF-8" indent="yes"/>

  <xsl:template match="/">
    <html>
      <head>
        <title>Listado de Usuarios</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Estilos personalizados -->
        <style>
          body {
            background-color: #f9fafb;
            font-family: 'Segoe UI', sans-serif;
            padding-top: 40px;
          }
          .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
          }
          h1 {
            color: #333;
            font-weight: 600;
            margin-bottom: 30px;
          }
          table th {
            background-color: #343a40;
            color: white;
          }
          table td, table th {
            vertical-align: middle;
          }
        </style>
      </head>
      <body>
        <div class="container">
          <h1 class="text-center">Listado de Usuarios</h1>

          <table class="table table-bordered table-hover align-middle text-center">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Rol</th>
              </tr>
            </thead>
            <tbody>
              <xsl:for-each select="usuarios/usuario">
                <tr>
                  <td><xsl:value-of select="@id"/></td>
                  <td><xsl:value-of select="nombre"/></td>
                  <td><xsl:value-of select="correo"/></td>
                  <td><xsl:value-of select="contraseña"/></td>
                  <td><xsl:value-of select="rol"/></td>
                </tr>
              </xsl:for-each>
            </tbody>
          </table>
        </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
