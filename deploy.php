<?php
namespace Deployer;

require 'recipe/wordpress.php';

// Project name
set('application', '<sitename>');

// Project repository
set('repository', '<git repo url>');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', [".env", "salts.php"]);
set('shared_dirs', ["wp-content/uploads","wp-content/languages"]);

// Writable dirs by web server 
set('writable_dirs', []);
set('allow_anonymous_stats', false);

set('env', [
    'COMPOSER_AUTH' => file_get_contents("auth.json"),
]);

set('composer_options', function() {
  return (input()->getArgument('stage') == 'prod')?"{{composer_action}} --no-dev ":"{{composer_action}}";
});

// Hosts

inventory('hosts.yml');

Desc('restart PHP');
task('phprestart', 'reloadPHP.sh');

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'phprestart',
    'success'
]);



// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// TODO: add wp cache flush to tasks
// TODO: add lines to .htaccess
// TODO on new hosts:
// 1. copy ssh keys
// 2. create ~/.wp-cli/config.yml with content:
// apache_modules:
//  - mod_rewrite
// use -> local
// https://github.com/cstaelen/deployer-wp-recipes/blob/master/recipes/cleanup.php
