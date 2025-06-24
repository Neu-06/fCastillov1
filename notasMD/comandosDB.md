# ***Comandos para la base de datos*** 
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
## crear un model
`php artisan make:model Marca`
##
`php artisan db:wipe`