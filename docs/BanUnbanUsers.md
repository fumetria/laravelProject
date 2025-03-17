# Bloqueo de usarios o desactivar cuentas

Para crear un función para desactivar o activar cuentas, vamos a usar un Middleware el comprobará que el usuario esta activo o no, en caso de no estar activo, devolverá al usuario a la página de Login, donde le mostrará un error.

## Creación del Middleware

Para crear un Middleware usaremos el comando de artisan:

```bash

php artisan make:middleware CheckUserIsActive

```

Una vez creado, abrimos el archivo creado en la ruta:

**app\Http\Middleware\CheckUserIsActive.php**

Y modificamos nuestra función handle():

```php

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->is_active) {
            Auth()->guard('web')->logout();
            return redirect('/login')->with(['error' => 'cuenta desactivada']);
        }
        return $next($request);
    }
```

Este middleware comprobará que el usuario este autenticado y en caso de no estar activo, hará **logout** y redirigirá a la página de login.

## Registrar el Middleware en nuestra App

Una vez creado nuestro middleware, tenemos que registrarlo en nuestro sistema. Para ello nos iremos a **bootstrap\app.php**

La carpeta bootstrap contiene los archivos que cargan la aplicación y preparan el entorno para la ejecución.

Una vez dentro, añadiremos nuestro middleware dentro del apartado ->withMiddleware().

```php
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
            \App\Http\Middleware\CheckUserIsActive::class
        ]);

        //
    })
```

Con esto hecho, ahora todas las rutas que requieran del middleware de autenticación, ejecutará nuestro middleware de chequeo si esta activo y si no lo esta devolverá a la página de login.

```php
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (!auth()->user()->is_employee) {
            return redirect('/catalog');
        } else {
            return Inertia::render('Dashboard');
        };
    })->name('dashboard');
});
```

## Mostrar mensaje de error cuando la cuenta esta desactivada

Anteriormente, hemos añadido ->with() al hacer redirect para enviar un mensaje de error en nuestro middleware.

```php
return redirect('/login')->with(['error' => 'cuenta desactivada']);
```

Esto es un redirect con datos de sesión flasheados.
Redirigir a una nueva URL y flashear datos en la sesión suelen hacerse al mismo tiempo. Normalmente, esto se hace después de realizar una acción con éxito, cuando envías un mensaje de éxito a la sesión. Para mayor comodidad, puedes crear una instancia de RedirectResponse y flashear datos en la sesión en una única cadena de métodos fluida:

```php
Route::post('/user/profile', function () {

    // ...

    return redirect('/dashboard')->with('status', '¡Perfil actualizado!');
});
```

Después de que el usuario sea redirigido, puedes mostrar el mensaje flasheado desde la sesión. Por ejemplo, usando la sintaxis de Blade:

```php
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
```

Para poder realizar esto en Inertia y Vue, primero debemos modificar el middleware **HandleInertiaRequest** que tenemos enn nuestra ruta _app\Http\Middleware\HandleInertiaRequests.php_ para que Laravel e Inertia permitan compartir datos globalmente. Modificaremos la función _share()_.

```php

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'flash' => [
                'error' => session('error')
            ]
        ]);
    }
```

En nuestro caso, usamos la variable error para que recoja datos del dato en session error que hemos enviado anteriormente. Con esto configurado, ya solo queda modificar nuestro archivo Vue para que nos muestre el error cuando hacemos login:

```Vue
<script setup>
import { usePage } from '@inertiajs/vue3';
...
import { computed } from 'vue';

defineProps({
    ...
    error: String
});
.
.
.
const page = usePage();
const flashError = computed(() => {
    return page.props.flash.error;
});
</script>
<template>
   ...
            <div class="flex items-center justify-end mt-4">
                ...
                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
            <p class="text-red-600">{{ flashError }}</p>
    ...
</template>
```

Mediante *usePage()* crearemos la variable **page** con el que accederemos a nuestros datos flash, luego mediante la función computed(), modificaremos nuetra variable **flashError** para que nos muestre los errores que envie nuestro controlador.


