# TECHBOX

Inside the laradock folder, in the terminal, execute the commands below to upload the containers needed to run the application.

```
cp. .env-example. env

docker-compose up -d nginx rabbitmq mysql phpmyadmin
```

To access bash

````
docker-compose exec workspace bash
````

To run migrations, inside workspace

````
cd techbox
cp. .env-example. env
php artisan migrate
````


Add the server_name included in the nginx configuration file to the hosts file, in our example the server_name is techbox.test

To access application
http://techbox.test/

To access rabbitmq
http://localhost:15672/#/

#### user && password: guest

To publish in rabbitmq
http://techbox.test/send

To consume in rabbitmq
http://techbox.test/consumer


