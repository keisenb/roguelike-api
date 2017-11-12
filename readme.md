# Roguelike API

## Install Docker
+ install docker - https://docs.docker.com/installation/
+ install docker-compose - https://docs.docker.com/compose/install/

## Initial Setup (follow the steps carefully)
+ `git clone https://github.com/keisenb/cis560-team7-backend.git`
+ `./lumen install` to install dependencies and start container
+ `./lumen migrate` to run the lumen migrations
+ `./lumen seed` to seed the tables with starter data
+ go to http://localhost and you should see Lumen landing page (if everything is in order)

#### Execute Artisan Command
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


## Uninstall Docker Contrainers

#### Removing all running containers
`docker rm -f $(docker ps -a -q)`

#### Removing all images
`docker rmi $(docker images -q)`
