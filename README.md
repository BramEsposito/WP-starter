# WP-starter
Starter configuration to install Wordpress with Composer

## required tools

- [composer](https://getcomposer.org/)
- [deployer](https://deployer.org/)
- [WP cli](https://wp-cli.org/)

## usage

1. clone this repository
2. setup your Apache and MySQL, create a database
3. copy .env.example to a new file .env
4. edit the .env file in a text editor
5. copy example_salts.php to salts.php and provide it with the values generated [here](https://api.wordpress.org/secret-key/1.1/salt/)
6. edit hosts.yml [with the values relevant for your environments](https://deployer.org/docs/hosts.html)
7. Add a new file auth.json with [your composer auth keys](https://getcomposer.org/doc/articles/authentication-for-private-packages.md#http-basic)
8. run composer install


## how to deploy

be sure you have access to your git repositories from the server before trying to deploy

run ```dep deploy staging``` for deploy on Staging  
run ```dep deploy prod``` for deploy on Production
