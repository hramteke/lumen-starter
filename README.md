## Lumen Starter Template [![Build Status](https://travis-ci.org/realpage/lumen-starter.svg?branch=master)](https://travis-ci.org/realpage/lumen-starter) [![Dependency Status](https://www.versioneye.com/user/projects/5711482afcd19a00415b180c/badge.svg)](https://www.versioneye.com/user/projects/5711482afcd19a00415b180c)

This [Laravel Lumen](https://lumen.laravel.com) starter template is intended to be forked and used for new projects.

## README Contents

* [What's Included](#whats-included)
* [Requirements](#requirements)
* [Using This Repository](#using-this-repo)
* [Continuous Integration/Deployment Workflow Diagram](http://realpage.github.io/lumen-starter/ci-cd-foundation-lumen-starter-workflow.png)

> For details on how to contribute to this repo, please check out the [contributing guide](https://github.com/realpage/lumen-starter/blob/master/CONTRIBUTING.md).

<a name="whats-included" />
### What's Included

 * Latest version of Lumen
 * Pre-configured `docker-compose.yml` that uses nginx, php-fpm and PostgreSQL
 * [Travis-CI](https://travis-ci.org) integration:
    * checks [psr-2 compliance](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) (with [phpcs](https://github.com/squizlabs/PHP_CodeSniffer))
    * runs [phpunit](https://phpunit.de/) tests within docker containers
    * pushes deploy-ready containers for `develop`, `staging`, `master` branches to [DockerHub](http://hub.docker.com)
 * [Dredd support](https://github.com/apiaryio/dredd) for ensuring accurate API documentation

<a name="using-this-repo" />
### Using This Repository

1. FORK this repo **(do not clone)**
2. Reference the [contributing guide](https://github.com/realpage/lumen/blob/master/CONTRIBUTING.md) for running this application locally
3. After running locally `docker exec -it $(docker ps -f name=fpm -q) php artisan clean:template` to strip out example migrations, seeds, tests, etc...

### FAQ

#### Is there a shortcut for running commands within specific containers?

Yes!  [Using an alias](http://askubuntu.com/a/17537/132639) below, you can run commands in containers with `dockerexc fpm php -v` instead of `docker exec -it $(docker ps -f name=fpm -q) php -v`.

```
alias dockerexc='function _docker_exec(){ service=$1; shift; docker exec -it $(docker-compose ps -q ${service}) "$@" };_docker_exec'
```
