# CRUD PHP ORIENTADO A OBJETOS version V1.0
_Es una estructura **PHP** que permite a los desarrolladores tener una base para comenzar sus proyectos orientado a objeto sin lo complicado de iniciar de cero o tener q conocer lo complejo de un framework.

- Realiza autocarga de todos los archivos php que estén en la carpeta model, view, controller y librerias, asi que se puede anexar alli todo lo que se necesite sin tener que incluirlos manualmente.
- Maneja herencias, entre la que destaca su propio sistema de paginación, que permite personalizar sus consultar y manejar gran volumen de registros sin que la velocidad de respuesta se vea afectada
- Esta versión no maneja rutas amigables, debido a que algunos servidores no lo permiten, por lo tanto en la url se le debe pasar por parámetros el nombre del controller y el nombre del action o metodo, en el archivo correr.php esta el controller y método por default, toda esta información puede ser adaptada a los requerimientos
- realiza las operaciones basicas **CRUD**, mediante ajax y empleando modal, esto se hace con una librería personalizada lo q hace la navegabilidad amena y la programación sencilla

**Herramientas**
- PHP 7.*
- MYSQL
- jquery
- toastr 'manejo de mensajes'
- materialize
- validaciones personalizadas

**instalacion**
- Descargue o clone el repositorio en la carpeta www de su servidor
- Ejecute en la base de datos el archivo Crud-Mysql-php.sql
- En el archivo connection.php configure los datos de la base de datos de acuerdo a su conexión 

## Autor

Josue Yoel Perez Fernandez
