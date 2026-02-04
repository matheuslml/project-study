<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/npm.php';
require 'contrib/php-fpm.php';

require 'recipe/common.php';

set(
    'shared_dirs', ['storage']
);

set(
    'shared_files', ['.env']
);

set('application', 'pmac-site.arraial.rj.gov.br');
set('repository', 'git@github.com:pmaccode/pmac-site.git');
set('http_user', 'www-data');
set('git_tty', false);
set('default_timeout', 0);
set('php8.2-fpm', '8.2');

host('develop')
    ->set('remote_user', 'aron')
    ->set('hostname', '192.168.10.10')
    ->set('port', '22')
    ->set('deploy_path', '/var/www/{{application}}/develop')
    ->set('multiplexing', true);

host('production')
    ->set('remote_user', 'aron')
    ->set('hostname', '192.168.10.10')
    ->set('port', '22')
    ->set('deploy_path', '/var/www/{{application}}/production')
    ->set('multiplexing', true);

    task('deploy', [
        'deploy:prepare',
        'deploy:vendors',
        'artisan:storage:link',
        'artisan:view:cache',
        'artisan:config:cache',
        'artisan:migrate',
        'npm:install',
        'npm:run:prod',
        'artisan:optimize',
        'deploy:publish',
        'php-fpm:reload',

    ]);

    task('artisan:optimize', function () {
        run('echo comando optimize desativado');
    });

    task('artisan:config:clear', function () {
        cd('{{release_path}}');
        run('php artisan config:clear');
    });

    task('composer:dumpautoload', function () {
        cd('{{release_path}}');
        run('composer dumpautoload');
    });

    task('npm:run:prod', function () {
        cd('{{release_path}}');
        run('npm install;npm run production;');
    });

    after('artisan:optimize', 'artisan:config:clear');
    after('artisan:config:clear', 'artisan:migrate');

    after('deploy:failed', 'deploy:unlock');
