## Starting Clean
+ install docker - https://docs.docker.com/installation/
+ install docker-compose - https://docs.docker.com/compose/install/

## Setup (follow the steps carefully)
+ `git clone https://github.com/keisenb/cis560-team7-backend.git`
+ `./lumen install` to install dependencies and start container
+ `./lumen migrate` to run the lumen migrations
+ go to http://localhost and you should see Lumen landing page (if everything is in order)


### Removing all running containers
`docker rm $(docker ps -a -q)`

### Removing all images
`docker rmi $(docker images -q)`


### Starting Docker Containers

Run `./lumen up` to start the container

### Stopping Docker Containers
To stop the container run `./lumen down`

## Seed Files (Temp Command)
+ `docker exec phpfpm php /srv/http/artisan db:seed` (seeds with sample data)
