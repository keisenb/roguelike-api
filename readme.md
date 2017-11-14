# Roguelike API

---
### Installation


 After you clone the repository install dependencies.
> `composer install`

Copy the example env file
> `cp .env.example .env`

Give permissions to env file
>  `chmod 777 .env`

generate a random string for app key and add it to the APP_KEY property in env (length of 32)

Change permissions for storage and bootstrap folders
> `chmod -R 777 bootstrap`
> `chmod -R 777 storage`

Run the migrations and seed the database
> `php artisan migrate --seed`

---
### Swagger Documentation
When writing API Endpoints please add Swagger documentation to the endpoints to
specify required parameters and expected responses.
You can find more information about Swagger [here](https://github.com/zircote/swagger-php/blob/master/docs/Getting-started.md).

Once you have added documentation to a controller endpoint you can regenerate
the `/api/documentation` view with the following command:
+ `php artisan swagger-lume:generate`

---
### Lumen PHP Framework

#### Official Documentation

Documentation for the framework can be found on the [Lumen website](http://lumen.laravel.com/docs).

#### License

The Lumen framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
