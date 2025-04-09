![Library app logo](/public/img/libraryLogos.PNG)

# Library App

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

Ejecutamos script dev
```bash
npm run dev
```

Abrimos una nueva terminal

```bash
php artisan migrate:fresh -seed
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

## Uso file storage para mostrar portadas

```bash
php artisan storage:link

cp -r /public/img/noimage.png /storage/app/public/covers/
```

### TODO

-   Crear vista para usuarios(no registrados)
-   Vista modificar permisos de usuarios ✔
-   Mejorar interfaz
-   Crear vista con historial de libros en el perfil del usuario
-   Crear sistema de notificaciones
