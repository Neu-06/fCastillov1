# ***Comandos para GIT/GITHUB***
#### comandos para push en git en ramas existentes
~~~ 
git add .
git commit -m "Avances del ciclo1"
git push origin nombre-de-la-rama
~~~
#### comandos para descargar actualizaciones en una rama
`git pull origin main`
#### ver ramas disponibles
`git branch`
#### crear nueva rama
`git branch nombre-de-la-rama`
### moverse a una rama existente
`git checkout nombre-de-la-rama`
### crear y moverse a una rama
`git checkout -b nombre-de-la-rama`

# Comandos para la base de datos 
### resetear las migraciones 
###### 1. Elimina todas las tablas.
###### 2. Vuelve a ejecutar todas las migraciones 
###### (incluyendo las nuevas y las modificadas).
`php artisan migrate:reset`
### resetea y migra de nuevo con los seeders
`php artisan migrate:refresh --seed`
### migrar base de datos 
`php artisan migrate`
### ejecutar los datos de prueba seeders
`php artisan db:seed`
### ejecutar las migraciones y los seeders
`php artisan migrate --seed`
### crear una nueva migracion
`php artisan make:migration create_nombreDeTabla_table`
