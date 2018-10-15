# Raha™

Raha means Money in Estonian which is our primary market for this Financial and Accounting Software.
This software designed for small businesses and freelancers. It is built with modern technologies such as Laravel, Bootstrap, jQuery, RESTful API etc. Thanks to its modular structure, Raha provides an awesome App Store for users and developers.

* [Home](https://euresiacoders.com) - The house of Raha

## Requirements

* PHP 5.6.4 or higher
* Database (eg: MySQL, PostgreSQL, SQLite)
* Web Server (eg: Apache, Nginx, IIS)

## Framework

Raha uses [Laravel](http://laravel.com), the best existing PHP framework, as the foundation framework and [Modules](https://nwidart.com/laravel-modules) package for Apps.

## Installation

  * Install [Composer](https://getcomposer.org/download)
  * Open and point your command line to the directory you unzipped Raha
  * Run the following command: `composer install`
  * Finally, launch the [installer]

## Docker

It is possible to containerise Raha using the [`docker-compose`](docker-compose.yaml) file. Here are a few commands:

```
# Build the app
docker build -t raha .

# Run the app
docker-compose up -d

# Make sure you the dependencies are installed
docker-compose exec web composer install

# Stream logs
docker-compose logs -f web

# Access the container
docker-compose exec web /bin/sh

# Stop & Delete everything
docker-compose down -v
```

## Translation

Raha is ready for different language translation.

## License

Raha is released under the [MIT license](LICENSE.txt).

