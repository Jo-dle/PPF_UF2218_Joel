# PPF_UF2218

Dentro de este proyecto se presentará:

- Explicación Al Usuario

- Explicación Técnica

	- La estructura ordenada del sistema y la lógica (carpetas y archivos)

	- Como se realiza cada operación (Comentarios dentro del código)

	- Validaciones aplicadas (Comentarios dentro del código)



## Explicación Al Usuario

En esta web podemos:

	* Iniciar sesión
	* Acceder a los controles de administrador
	* limitar el acceso de quien no sea administrador


## Explicación Técnica

En el proyecto se puede observar un login con sesiones creada para controlar el acceso al uso y la visualización del CRUD

Limitación del acceso a los usos del CRUD

	* Ocultación de todos los botones del CRUD
	* Seguimiento de sesiones y boton de cerrar sesión controlado con session destroy()
	* Mensajes de confirmación del tipo de rol en el index


## Estructura Del Proyecto

El proyecto está todo englosado dentro de la carpeta homónima a este repositorio (E2_UF2218_Joel)

Y dentro de esta se encuentran tres carpetas:


### Controladores

Todo el código -backend- mayormente php

	c.editar.php

	c.insertar.php

	c.eliminar.php

	c.login.php

	c.logout.php
### Vistas

Todas las páginas a las que se redirige y muestran algo en pantalla con un estilo aplicado

	editar.php

	index.php

	insertar.php

	login.php

### xml

El núcleo del proyecto donde se guardan los archivos esenciales xml

	coches.xml

	coches.xsd

	coches.xsl

	usuarios.xml

	usuarios.xsd

	usuarios.xsl
