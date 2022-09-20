# Symfony 6.1, Bootstrap 5.1, Docker Boilerplate
### Symfony 6, PHP8.1, Bootstrap 5.1 Boilerplate with Docker  

A complete Symfony, PHP Development environment that is very similar to production environment.

Docker Compose based **Symfony development environment** with individual **App** _(Symfony app)_, **Nginx**, **Database** _(MySQL)_  services.

## Features
Coming Soon

## Installation
Coming soon.
## Docker Container management

### Build containers
Run this to build your docker containers for each service (*app, database, nginx*).
  ```
  docker-compose build
  ```

### Run the containers
  ```
  docker-compose up
  ```
 ### To run the services at background
  ```
  docker-compose up -d
  ```
### SSH into your app console
To **install Symfony**, you need to ssh to your app container service. To ssh to your app container, run this.
```
docker-compose exec app sh
```
This will take you to `/var/www/app` path inside your `app` service container. Now you can run your `composer install` and other Symfony or PHP specific commands there.

### Stop running containers
```
docker-compose stop
```

## Environment Variables
### PHP
If you want to change, enable/disable any PHP settings, you can change them in `./docker/config/php/php-ini-development.ini` file and then `build` and `up` the container again.
### MySQL
MySQL username, password can be changed from `docker-compose.yml` file. Fin the `environment` section under `mysql`. Change the value and build the mysql image again with `docker-compose build mysql`.
```
  environment:
    MYSQL_DATABASE: app
    MYSQL_ROOT_PASSWORD: root
    MYSQL_USER: root
    MYSQL_PASSWORD: root
```
After you change the value and build, you need to restart the mysql service `docker-compose up mysql` to make it affective. 
### Nginx
If you want to change Nginx web host configurations, you can find the file at `./docker/images/web/sites/default.dev.conf`
### Storage and Logs
This Symfony-docker-app leverage the power of `docker volume` and store some the docker container data at your host machine. Here is the details of folder structure and what data it contains:
- `./docker/data/mysql` contain mysql database files
- `./docker/log/nginx` contain nginx webserver logs
### Connecting MySQL with local desktop client.
```
host: 0.0.0.0
username: root
password: root
port: 33066
```

## Browse your site locally
You can find your site running at http://localhost

## Contribution
If you find any security hole or improvement opportunity, feel free to fork and PR your updates. I'll be happy to merge any reasonable PR.

### Contact
Email: `arifulhb@gmail.com`

#### Based on
Symfony-Docker-App: [https://github.com/arifulhb/symfony-docker-app](https://github.com/arifulhb/symfony-docker-app)

### Disclaimer
This docker environment is for development only and NOT optimized for production.
