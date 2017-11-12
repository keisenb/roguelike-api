# Roguelike API

## Install Docker
+ install docker - `sudo apt-get install docker`
+ install docker-compose - `sudo apt-get install docker-compose`

## Install Composer
+ `curl -sS https://getcomposer.org/installer | php`
+ if you get a permissions issue run `sudo chmod -R 777 /home/<user>/.composer`
+ `sudo mv composer.phar /usr/local/bin/composer.phar`
+ `alias composer='/usr/local/bin/composer.phar'`

## Initial Setup (follow the steps carefully)
+ `git clone https://github.com/keisenb/cis560-team7-backend.git`
+ `./lumen install` to install dependencies and start container
+ `./lumen migrate` to run the lumen migrations
+ `./lumen seed` to seed the tables with starter data
+ go to http://localhost and you should see Lumen landing page (if everything is in order)

#### Execute Artisan Commands
+ `docker exec phpfpm php /srv/http/artisan <command goes here>`

#### MySQL Connection Info
+ Username: `user`
+ Password: `password`
+ Port: `4406`
+ Host: `127.0.0.1`

#### Starting Docker Containers

Run `./lumen up` to start the container

#### Stopping Docker Containers
To stop the container run `./lumen down`


## Swagger Documentation
When writing API Endpoints please add Swagger documentation to the endpoints to
specify required parameters and expected responses.
You can find more information about Swagger [here](https://github.com/zircote/swagger-php/blob/master/docs/Getting-started.md).

Once you have added documentation to a controller endpoint you can regenerate
the `/api/documentation` view with the following command:
+ `php artisan swagger-lume:generate`

## Uninstall Docker Contrainers

#### Removing all running containers
`docker rm -f $(docker ps -a -q)`

#### Removing all images
`docker rmi $(docker images -q)`
