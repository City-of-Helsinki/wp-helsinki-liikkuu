# DockerPress

A Dockerrrrizzzed WordPress installation. This framework provides you with a PHP, MariaDB, Apache stack all pre configured to work out the box.

* Was Nginx all will be soon, until i make a base image that build and configures Nginx into same container*

## Architecture

We have 2 Dockerfiles. 1 for production which has Apache (soon Nginx) and PHP and copies files in the container, with correct users and permission so can be shipped around easily. And 1 for development which contains all the development tools and the app code is mounted in during development, this is orchestrated with Docker Compose.

We then have a seperate service running to host and run the `mysql`. Which in production could be replaced with an RDS.

## Requirements

* `em` mentioned below is our little Evermade helper that should be installed on your host machine, and can be found here: [https://bitbucket.org/evermade/em-helper](https://bitbucket.org/evermade/em-helper)

### Persistent storage

The `/data` folder holds persistent data such as databases. We could also use this folder to store logs etc.

### Database

The database is stored on the host machine at `/data/mariadb`

Credentials are stored `/app/env/.env`

Port `3306` is also exposed to your host so you can use connect to mysql locally if desired.

### Useful

* Refer to the Docker docs for more about commands [https://docs.docker.com/engine/reference/commandline/cli/](https://docs.docker.com/engine/reference/commandline/cli/)
* For docker-compose commands refer to [https://docs.docker.com/compose/reference/](https://docs.docker.com/compose/reference/)
* To install Docker on mac [https://docs.docker.com/docker-for-mac/](https://docs.docker.com/docker-for-mac/)
* To install Docker and/or Docker compose [https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-compose-on-ubuntu-14-04](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-compose-on-ubuntu-14-04)
* The app code is located in `/app`
* The web public serving code should be in `/app/dist`

## Contributors

* Paul Stewart 
* Jaakko Alajoki
* Juha Lehtonen 
* Pekka Wallenius
* Tuomas Hirvonen 
* Joonas Pyhtil�
