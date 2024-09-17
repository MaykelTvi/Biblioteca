
# Biblioteca
Proyecto Biblioteca
La estructura para la base de datos son tres tablas fundamentales: 
		Usuarios ! Libros ! Préstamos

Cada usuario tiene un identificador único, el id_usuario, que actúa como clave primaria en la tabla Usuarios. De la misma manera, cada libro tiene un id_libro como clave primaria en la tabla Libros. La tabla Préstamos se encarga de conectar ambas entidades, utilizando tanto el id_usuario como el id_libro como claves foráneas para registrar al usuario que tiene prestado un libro. Esto permite controlar que solo un libro esté prestado a un único usuario, pero un usuario puede pedir distintos libros a lo largo del tiempo.

	implementacion del administrador
En este proyecto estamos desarrollando una base de datos para gestionar una biblioteca digital, donde hay dos roles principales: el administrador y el usuario. El administrador tiene la tarea de agregar, modificar o eliminar libros del sistema, además de poder observar el estado de cada libro, ya sea que esté disponible, prestado o reservado. Por otro lado, los usuarios pueden explorar el catálogo de libros y pedir préstamos, aunque cada usuario solo puede tener limitados libros a la vez.

En cuanto a otras posibles implementaciones de cara al futuro podemos añadir funcionalidades como  reservar libros, implementar un historial de préstamos para los usuarios, y un sistema de notificaciones que les recuerde cuándo deben devolver los libros, la categorización de los libros. Todas estas ideas buscarían  que el sistema sea más eficiente, tanto para los administradores como para los usuarios.
##
##
![image](https://github.com/user-attachments/assets/b2abeba8-d53a-406d-9bc8-2e861fcf1356)
