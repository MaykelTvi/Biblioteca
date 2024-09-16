![image](https://github.com/user-attachments/assets/b2abeba8-d53a-406d-9bc8-2e861fcf1356)# Biblioteca
Proyecto bibilioteca

Explicación de _PK_ y _FK_:
_PK_ (Primary Key):
*id_usuario*: Es la clave primaria en la tabla **Usuarios**.
*id_libro*: Es la clave primaria en la tabla **Libros**.
*id_prestamo*: Es la clave primaria en la tabla **Préstamos**.

FK (Foreign Key):
*id_usuario*: Es clave foránea en la tabla **Préstamos**, y hace referencia a la tabla **Usuarios**.
*id_libro*: Es clave foránea en la tabla **Préstamos**, y hace referencia a la tabla **Libros**.

Cada usuario tiene un *id_usuario único* (_PK_ en Usuarios).Cada libro tiene un *id_libro* único (_PK_ en **Libros**). La tabla Préstamos conecta a los usuarios y los libros mediante las claves foráneas id_usuario y id_libro. La bibliotec contará con un administrador quien agregará y podrá descartar libros y observar el estado de estos (disponible o prestado). El usuario dispondrá de una lista de los libros disponibles para solicitar un prestamo si así lo desee.

