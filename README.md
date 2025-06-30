* Nombre completo: Vicente Neri Ventura
* Posición: Frontend

* Lenguajes:
    - PHP 80%
    - Javascript 80%
    - SQL: (MySQL) 70%

* Correo de contacto: Vizenthe13k@outlook.com

* Referencias de trabajo:
- José 000-000-0000
- Christian 000-000-0000

* Nivel de assement: Intermedio

> Instrucciones antes de empezar:
1. Copiar información del archivo ".env.sample", crear uno nuevo llamado ".env" y colocar credenciales para establecer conexión con la base de datos.
2. Iniciar servidor con PHP: php -S localhost:8000 -t public_html
Nota 💡: si tienes en uso el puerto 8000, intentar con otro, ej. 8001
3. En tu carpeta raiz ejecutar el comando: php php/init-db.php
Esto ejecuta el script.sql y creará la base de datos y sus respectivas tablas con sus datos
4. Utilizar sitio web 🎉.
5. Si deseas ejecutar el comando para visualizar el reporte (log) entonces ejecutar: php public_html/assets/Install/install.php
6. Para ejecutar el script para generar los 1k comentarios y 200 productos, ejecutar: php public_html/assets/Install/seeder.php


Actividades completadas:

> -- Creación de la base de datos
- Se crearon las tablas mínimas requeridas.
- INTERMEDIO/AVANZADO: + 2 tablas extras creadas (Marca, Modelo).
- INTERMEDIO: Se creó vista de producto con su información detallada.
- INTERMEDIO: Cada tabla debe de tener sus índices, llaves foráneas y constraints.
- INTERMEDIO: Agregando una nueva columna con la cantidad de visitas a cada producto (views).

- AVANZADO: Agregar una tabla o al menos 2 columnas de metainformación que se actualice automáticamente, relacionada a cada producto para guardar sus estadísticas como fecha de registro, fecha de modificación, cantidad de visitas
- AVANZADO: procedimiento para calcular una mensualidad con base en el precio de lista a 6 y 12 meses a 10% de interés anual.

> -- Archivo de configuración
- Conectar base de datos con PDO y 10 registros en cada tabla, con reporte de log.
- INTERMEDIO: Hacer un código donde genere 200 productos de forma aleatoria con especificaciones, marcas y modelos utilizando términos técnicos y precios en un rango de 10,000 hasta 60,000 MXN
- INTERMEDIO: código _Lorem Ipsum_ con 1,000 comentarios repartidos en los productos
- AVANZADO: cada producto deberá estar asociado a por lo menos una de 3 categorías distintas
- AVANZADO: en la carpeta PHP deberán estar todas las clases tanto controladoras como modelos, organizadas en espacios de nombres, así como un class loader que se incluirá en las vistas para utilizar las clases respectivas

-- Carpeta public_html
- .htaccess configurado para vistas
- Crear un home que muestre el listado de categorías padres dentro de un menú
- Listado de 10 productos seleccionados aleatoriamente bajo el texto de productos destacados.
- Al visitar un producto se abrirá una nueva página donde se mostrará el detalle del producto con sus especificaciones y comentarios.
- INTERMEDIO: el listado de productos destacados y más vendidos deberá ser mostrado en páginas para poder consultar todos los productos que aplican
- AVANZADO: agregar un campo y funcionalidad de búsqueda
- Screenshots de sitio web responsive con diferentes resoluciones en: /screenshots