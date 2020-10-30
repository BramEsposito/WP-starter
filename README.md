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

## how to add themes and plugins with composer

- go to https://wpackagist.org and find the theme or plugin you want to install
- run ```composer install wpackagist-plugin/pluginname``` for installing plugins
- run ```composer install wpackagist-theme/themename``` for installing themes
- if you provide a version you will need to update by running ```composer require``` again with the new version number

## how to add your own themes and/or plugins with composer

- run ```composer outdated```, this gives you an overview of available updates
- run ```composer update``` to update all available updates
- run ```composer update name/name``` to update a specific dependency
- commit & push the changes in ```composer.lock``` to origin 

## update changes from your theme

- open your theme repository 
- commit (```git add .```) (```git commit -m"message"```) and push (```git push```) your changes to origin
- add a new tag (```git tag 1.1```) and push it to origin (```git push origin --tags```)

## update WordPress, plugins & themes

- open the site root repository (cloned from this WP Starter template) and update your theme or plugin (```composer update myname/my-theme``` ) (check your composer.json for the name you have used)
- commit the changes to the composer.lock file to origin
- see how to deploy for the deploy commands


## how to deploy

be sure you have access to your git repositories from the server before trying to deploy

run ```dep deploy staging``` for deploy on Staging  
run ```dep deploy prod``` for deploy on Production


## tips and tricks

use https://gordalina.github.io/cachetool/ to reset the PHP cache after deploying when new changes are not propagated after deploy
