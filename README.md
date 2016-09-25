# Prácticas Tenologías Web
>Primer desarrollo con PHP

La práctica consiste en un sistema de gestión de tutorías (recursos). Los alumnos pueden apuntarse a la cola de los recursos y los profesores pueden administrar la cola de los recursos. Se trata de una cola con prioridad en la que se muestran en primer lugar los alumnos "sin terminar"(que tienen mayor prioridad), luego un alumno sin prioridad y luego otra vez los alumnos "sin terminar". La pantalla de visualización se encuentra en `/index.php/visualizacion`

En el archivo de la base de datos se incluye un usuario de tipo administrador, los roles profesor y administrador, y una entrada en la tabla rol_usuario que relaciona al usuario admin con el rol de administrador.

->Usuario admin
->Contraseña admin (Está cifrada con sha1...)




###### Importante
>La práctica ha sido realizada usando [Codeigniter](https://www.codeigniter.com/) 3.0.6, [jQuery](https://jquery.com/) ,[jQuery Validation Plugin](https://jqueryvalidation.org/) y [MySQL](https://www.mysql.com/).

>La configuración de la base de datos se encuentra en `Aplication/config/database.php`

>En el archivo `Aplication/config/config.php` es necesario establecer el directorio donde se guardan las sesiones con un directorio con al menos permisos de escritura `$config['sess_save_path'] = '.';`.

>Las validaciones se encuentran todas juntas en `public/js/validaciones.js` ( Por facilidad para elaborar la práctica).

>Las partes comunes a todas la páginas se encuentran en `application/views/templates` ( Debido a que no se ha usado ningún motor de plantillas la estructura de las vistas no es la mejor... )

> Las vistas y css están basados en [DECSAI](http://decsai.ugr.es)



___
###### Universidad de Granada (UGR)
___
