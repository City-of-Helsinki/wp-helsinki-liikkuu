# A WordPress Project 

A WordPress build.

## Initial Setup 

1. Copy and configure `env/.env.example` to `env/.env` (ensure all passwords are strong and filled in)
2. Run `./build.sh`
3. Pull in the [database](#Database)
4. Visit [http://localhost](http://localhost)

## Development tools

The development tools are bundled in with this project within the web service container rather than using `em`. This way tools and versions are created for that project and that time else things will get messy in the future. @todo will make an `em` alias to run the `docker exec` to reduce typing etc.

Some raw examples

* `docker exec -it CONTAINER_NAME npm run dev`
* `docker exec -it CONTAINER_NAME composer install`

Or head directly into the container and run commands as you would normal, no magic just as you would expect.

`docker exec -it CONTAINER_NAME bash`

From this you could run `wp user list --allow-root` inside the dist folder, no magic, just as it would be done without helpers, as that is where the WP installation is.

## Usage

* To spin up the Docker stack run `em docker this`
* To begin to develop, run `em npm run dev`
* Due to the `src` / `dist` build nature, the above must be running when making file and ACF changes.
* All WordPress / PHP libraries must go through [Composer](https://getcomposer.org/) using a 3 digit versioning convention.
* All front end dependencies must go through [NPM](https://www.npmjs.com/) using a 3 digit versioning convention.

## Everblox

Everblox will seamlessly integrate into this build, with Gulp automatically copying and watching the PHP, SCSS and JS.

* `em everblox add BLOCK NAME`

* `em everblox add example my-new-block` will clone the `example` block to a new block called `my-new-block`

The `block` parameter is the block git repository name, omitting the `-block` suffix, which is added due to the lack of project namespaces available in Bitbucket repository URLs.

The `name` parameter allows you to clone a block under a different name. This way it allows you to build blocks from another block as a base or simply run multiple versions of a block in the future using different unique names.

The `name` parameter can be omitted if you want the name to simply be the name of the block repository your cloning, ie if unique already.

* `em everblox add example` will clone and create a block called `example`

### Database

We have database push and pull tasks available through [Flightplan](https://github.com/pstadler/flightplan). Whether you can push a database into a target is set in the `flightplan/project.conf.js` file.

First run a test to see if you can connect to your desired target `em fly test:production`.

If ok now we can sync our databases.

* `em fly dbPull:production` to pull the production database to your local database
* `em fly dbPush:staging` to push your local database to staging

Both push and pull tasks perform a `WP CLI` search and replace. However multisite setup will require a little amend to those queries.

## Deployment

We currently use Node [Flightplan](https://github.com/pstadler/flightplan) for deployment.

**Note:** the below uses a reference to `/tmp/agent.sock` which is not available on Mac but rather Linux only, so you will need to create symbolic link to the Mac equivalent if you want this working on your Mac.  

* `em fly ping:staging` to do a test ping connection
* `em fly test:staging` to test the target configuration is ok
* `em fly deploy:staging` to deploy the staging

## Composer

To run these [Composer](https://getcomposer.org/) related commands

* `em composer install --no-dev`
* `em composer update --no-dev`

## WP CLI

To run [WP CLI](http://wp-cli.org/) related commands

* `em wp user list`
* `em wp search-replace 'http://old.domain' 'http://new.domain'`

## Security

To run some basic security tests, you can use WP Scan:

* `docker run --rm wpscanteam/wpscan -u https://www.evermade.fi --enumerate u --basic-auth demo:demo`

## Project Details

## Gulp

* If you need to add more files to the Gulp watch, for example a WP plugin, a JS or CSS library, then add it to the corresponding index in the `gulpfile.js` paths object.

## Care

Simple deployment. To set up a target open `flightplan/project.conf.js` and add there.

* `em fly deploy:TARGET`

Available targets:

* `em fly deploy:staging`
* `em fly deploy:production`

## Found a bug?

If you have an issue or have found a bug, please [create an issue](https://bitbucket.org/evermade/dockerpress/issues/new).

## Contributors

* Paul Stewart