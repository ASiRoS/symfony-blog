Installation guide.

Run: composer install, follow it instructions.

To create database schema, use command:
    php bin/console doctrine:database:create

To make schema use command:
    php bin/console doctrine:database:update --force
    
To load fixtures use command:
    php bin/console doctrine:fixtures:load

Project has built in server, to run, use command:
    php bin/console server:start or server:run
    
Project was written on Ubuntu 18.04, php version 7.2.17, using built-in web server.

If something does not work, you may need to use docker.

If you run fixtures, you will have default user:
username: admin password: 123456
He has access to admin area!
