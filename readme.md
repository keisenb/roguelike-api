## Starting Clean
+ install docker - https://docs.docker.com/installation/
+ install docker-compose - https://docs.docker.com/compose/install/

### Removing all running containers
`docker rm $(docker ps -a -q)`

### Removing all images
`docker rmi $(docker images -q)``

## Basic (follow the steps carefully)
+ `git clone https://github.com/keisenb/cis560-team7-backend.git`
+ `./lumen install` to install dependencies and start container
+ Run `./lumen up` to start the container
+ To stop the container run `./lumen down`
+ go to http://localhost and you should see Lumen landing page (if everything is in order)

## Lumen
+ `docker exec phpfpm php /srv/http/artisan migrate` (this will create a sample migration)
+ `docker exec phpfpm php /srv/http/artisan db:seed` (seeds with sample data)
