Purl [![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy?template=https://github.com/veloxy/purl)
====

Purl (Petite URL) is an open source project with the goal of providing you with your own private URL shortener!

![](https://goo.gl/HstQ5n)

This project was my first symfony project, keep in mind that there are a lot of improvements that could be made. The point of this project was to **learn** symfony, and I happened to need a URL shortener.

You are welcome to send pull requests if you like!

## Development

[Check the docker guide](https://github.com/veloxy/purl/tree/master/src/AppBundle/Resources/docs/docker.md) if you want to use the docker images, if you use your own workflow, continue reading!

### Install

Install the required packages.

```
composer install
```

Create the database scheme, add an admin, install assets:

```shell
bin/console doctrine:schema:create
bin/console fos:user:create admin test@example.com admin
bin/console fos:user:promote admin ROLE_ADMIN
bin/console assets:install
```

You will be asked to enter some parameters, adjust them to your own needs.

Once done, you should be ready to go. You can access the admin on /admin and log in using your previously created admin user.

![](https://goo.gl/uhNULT)

### Testing


Create a database named `test` and make sure the `dev` mysql user has access to it. Then create the schema for the test environment:

```shell
bin/console doctrine:schema:create -e test
```

Once the database is set up, you simply run `phpunit`:

```shell
vendor/bin/phpunit
```

## REST API

REST API docs can be found [here](http://docs.purl.apiary.io/#)

## Credits

- Background image by Roman Pohorecki ([source](https://www.pexels.com/photo/mountains-landscape-winter-snow-15382/))
