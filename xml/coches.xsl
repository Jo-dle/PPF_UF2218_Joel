<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html" encoding="UTF-8" indent="yes"/>
  <xsl:param name="rol"/>

  <xsl:template match="/">
    <html>
      <head>
        <title>Listado de Coches</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <!--Link a bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!--script para confirmación en la eliminación de coches-->
        <script type="text/javascript">
          function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar este coche?");
          }
        </script>
        <!--Estilos de la página-->
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
          .btn {
            border-radius: 8px;
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
      <!--empezamos el listado de los coches-->
      <body>
        <div class="container">
          <h1 class="text-center">Listado de Coches</h1>
          <!--Botón que nos redirecciona a la pagina insertar para crear un coche nuevo-->
          <xsl:if test="$rol ='administrador'">
          <!--Botones de navegación-->
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <a href="insertar.php" class="btn btn-primary btn-sm me-2">
                        ➕ Introducir coche
                    </a>
                    <a href="buscar_coche.php" class="btn btn-success btn-sm">
                        🔍 Buscar coche
                    </a>
                </div>
                <a href="../controladores/c.logout.php" class="btn btn-outline-secondary btn-sm">
                    🚪 Cerrar sesión
                </a>
            </div>
          </xsl:if>
          <!--añadimos el id de la tabla para poder usar datatables de bootstrap-->
          <table id="tabla-coches" class="table table-bordered table-hover align-middle text-center">
            <thead>
              <tr>
                <th>Matrícula</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Puertas</th>
                <th>Color</th>
                <th>Precio (€)</th>
                <th>Tipo de venta</th>
                <xsl:if test="$rol ='administrador'">
                <th>Acciones</th>
                </xsl:if>
              </tr>
            </thead>
            <tbody>
              <!-- seleccionamos la información de cada coche del documento xml-->
              <xsl:for-each select="coches/coche">
                <tr>
                  <td><xsl:value-of select="@matricula"/></td>
                  <td><xsl:value-of select="marca"/></td>
                  <td><xsl:value-of select="modelo"/></td>
                  <td><xsl:value-of select="puertas"/></td>
                  <td><xsl:value-of select="color"/></td>
                  <td><xsl:value-of select="concat(precio, ' €')"/></td>
                  <td><xsl:value-of select="precio/@venta"/></td>
                  <xsl:if test="$rol = 'administrador'">
                  <td>
                    <div class="d-flex justify-content-center gap-2">
                      <a>
                        <!--Botón que nos redirecciona a editar-->
                        <xsl:attribute name="href">
                          <xsl:text>../vistas/editar.php?matricula=</xsl:text>
                          <xsl:value-of select="@matricula"/>
                        </xsl:attribute>
                        <button class="btn btn-primary btn-sm">✏️ Editar</button>
                      </a>
                      <a class="btn btn-danger btn-sm">
                        <!--Botón que llama al código de eliminar-->
                        <xsl:attribute name="href">
                          <xsl:text>../controladores/c.eliminar.php?matricula=</xsl:text>
                          <xsl:value-of select="@matricula"/>
                        </xsl:attribute>
                        <!--Mensaje de confirmación al borrar-->
                        <xsl:attribute name="onclick">return confirmarEliminacion()</xsl:attribute>
                        🗑️ Eliminar
                      </a>
                    </div>
                  </td>
                  </xsl:if>
                </tr>
              </xsl:for-each>
            </tbody>
          </table>
        </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
