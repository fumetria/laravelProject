![Library app logo](/public/img/libraryLogos.PNG)

# Library App

## Introducción
Como estudiante de DAW, el siguiente proyecto ha sido creado con el fin de entender el funcionamiento del framework Laravel junto con el kit Laravel Jetstream (Inertia + Vue) y como base datos usaremos mySQL.
<p align="center">
  <a href="https://skillicons.dev">
    <img src="https://skillicons.dev/icons?i=laravel,vue,mysql,tailwind&theme=light" />
  </a>
</p> 

## ¿Qué es Library App?

Library App es un aplicación para la gestión de una biblioteca. Esta enfocada en tener un sistema organizado con los libros de los que se dispone, gestionar los préstamos y devoluciones de libros y dar un servicio de consulta para los usuarios que busquen la ubicación de algún libro que quieran alquilar.

## Instalación

```bash

git clone https://github.com/fumetria/laravelProject.git /ubicación

cd /ubicación

composer install

npm install

```

Copiamos nuestro archivo _.env.example_ en _.env_ y configuramos nuestra base de datos.
Desde la terminal ejecutamos:

```bash
cp .env.example .env
```

Generamos clave del proyecto
```bash
php artisan key:generate
``` 

### Uso file storage para mostrar portadas

```bash
php artisan storage:link

cp -r public/img/covers/ storage/app/public/covers/
cp -r public/img/authors/ storage/app/public/authors/
```

Ejecutamos script dev
```bash
npm run dev
```
o script build si queremos desplegar a producción
```bash
npm run build
```

Abrimos una nueva terminal

```bash
php artisan migrate:fresh --seed
php artisan serve
```

## Pruebas

Para probar tenemos el siguiente usuario habilitado:

```
admin@example.com
admin1234

employee@example.com
employee1234

user@example.com
user1234
```

## Características

-   La aplicación actualmente trabaja en su mayor parte desde el server-side.
-   Sistema de alta de libros funcional.
-   Sistema de gestión de prestamos funcional.

## Generación de etiquetas con código de barras de los libros

Mediante el modulo *milon/barcode* podemos generar una etiqueta con el código de barras del libro. Con esta etiqueta, podemos imprimir la en una impresora de etiquetas para pegar en el libro correspondiente.

### TODO

- Sistema para la impresión de etiquetas e impresión en impresoras de etiquetas.

## TODO

-   Crear vista para usuarios(no registrados) (Welcome  ✔, catálogo  ✔, comunidad, eventos, otros )
-   En vista listado de usuarios, añadir:
    - Mostrar detalle de usuario
    - Actualizar datos de usuario
    - Eliminar usarios
-   Vista modificar permisos de usuarios ✔ [+info](/docs/BanUnbanUsers.md)
    - Terminar funcionalidades de panel de permisos (is_employee, is_admin)
-   Mejorar interfaz
-   Crear vista con historial de libros en el perfil del usuario
-   Crear sistema de notificaciones
-   Crear sistema de reserva de libros
-   Crear sistema de notificación de demoras de devoluciones para los empleados
    - Desplegable con lista de las distintas incidencias
    - Al clicar una incidencia muestra datos de contacto del cliente
    - Posibilidad de marcar como incidencia resuelta
    - CRM de estado de la incidencia
-   Crear sistema comunidad (Blogs personales, foro o micromensajes tipo Twitter?)
-   Calendario de eventos (Añadir eventos, enviar newsletter...)

