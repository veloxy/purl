
## Development using Docker

To get started with docker, go and read the article "[Docker PHP development flow](http://tech.yappa.be/docker-php-development)"

I'll assume you have docker installed and ready so we'll start off by launching the containers:

```
docker-compose -f etc/docker/docker-compose.yml up -d
```

Next up, we symlink the vendors to improve speed. We do this by going into the container:

```shell
docker exec -it docker_php_1 bash
```

In the container, we set up the link to the vendor folder and install the vendors:

```shell
ln -s /vendor vendor
composer install
```

Create the database scheme, add an admin, install assets:

```shell
bin/console doctrine:schema:create
bin/console fos:user:create admin test@example.com admin
bin/console fos:user:promote admin ROLE_ADMIN
bin/console assets:install
```

At this point, vendors are installed and ready to go. If you use an IDE that provides auto completion, it would be handy to install the vendors locally too. So exit out of the container and run the following:

```shell
COMPOSER_VENDOR_DIR=_vendor /usr/local/bin/composer --no-autoloader --no-scripts install
```

You will be asked to enter some parameters, the default will suffice.

You are now able to surf to http://purl.docker, you can log into the admin at http://purl.docker/admin using your previously created admin user.

![](https://goo.gl/uhNULT)

#### Optional

It might be useful to create an alias to update local vendors, so add this to your .bash_profile:

```shell
alias composer-local='COMPOSER_VENDOR_DIR=_vendor /usr/local/bin/composer --no-autoloader --no-scripts'
```

Now you can update local vendors using `composer-local` instead of `composer`, this will put vendors in the _vendor directory and the container wont have to load the vendors files over the mount.


### Testing

Go to the php container:

```shell
docker exec -it docker_php_1 bash
```

Create a database named `test` and make sure the `dev` mysql user has access to it. Then create the schema for the test environment:

```shell
bin/console doctrine:schema:create -e test
```

Once the database is set up, you simply run `phpunit`:

```shell
vendor/bin/phpunit
```