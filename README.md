# Helsinki Liikkuu WordPress project

Helsinki Liikkuu WordPress website with new Helsinki brand. Uses ACF as a backend for website building blocks.

## Initial Setup

1. Copy and configure `env/.env.example` to `env/.env` (ensure all passwords are strong and filled in)
2. Run `./build.sh`
3. Visit [http://localhost](http://localhost)

## Development tools

The development tools are bundled in with this project within the web service container.

Some raw examples

- `docker exec -it CONTAINER_NAME npm run dev`
- `docker exec -it CONTAINER_NAME composer install`

Or head directly into the container and run commands as you would normal, no magic just as you would expect.

`docker exec -it CONTAINER_NAME bash`

From this you could run `wp user list --allow-root` inside the dist folder, no magic, just as it would be done without helpers, as that is where the WP installation is.

## Usage

- To spin up the Docker stack run `docker-compose --build up`
- To begin to develop, run `docker exec -it CONTAINER_NAME npm run dev`
- Due to the `src` / `dist` build nature, the above must be running when making file and ACF changes.
- All WordPress / PHP libraries must go through [Composer](https://getcomposer.org/) using a 3 digit versioning convention.
- All front end dependencies must go through [NPM](https://www.npmjs.com/) using a 3 digit versioning convention.

## Composer

To run these [Composer](https://getcomposer.org/) related commands

- `docker exec -it CONTAINER_NAME composer install --no-dev`
- `docker exec -it CONTAINER_NAME composer update --no-dev`

### Database

The database is stored on the host machine at `/data/mariadb`

Credentials are stored `/app/env/.env`

Port `3306` is also exposed to your host so you can use connect to mysql locally if desired.

1. [Docker architecture](dockerpress.md)
2. [Setup, building and deployment](app/README.md)
3. [SWISS / Everblox theme](src/wp-content/themes/swiss/README.md)
