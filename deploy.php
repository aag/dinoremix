<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'dinoremix');

// Project repository
set('repository', 'git@github.com:aag/dinoremix.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys 
set('shared_files', [
    'data/AlreadyDownloaded.txt',
    'data/GuestComicsURLs.txt',
]);
set('shared_dirs', [
    'data/comics',
    'data/filelists',
    'public/panels',
]);


// Hosts

host('dinoremix.definingterms.com')
    ->user('deployer')
    ->forwardAgent(true)
    ->stage('production')
    ->set('deploy_path', '/var/www/dinoremix');
    

// Tasks

task('deploy:npm_install', function () {
    cd('{{release_path}}');
    $output = run('npm install');
})->desc('Install npm modules');

task('deploy:npm_build', function () {
    cd('{{release_path}}');
    $output = run('npm run build');
})->desc('Build frontend assets');

task('deploy:fpm_restart', function () {
    $output = run('sudo service php7.1-fpm restart');
})->desc('Restart PHP-FPM');

desc('Deploy Dinosaur Remix');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:npm_install',
    'deploy:npm_build',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:fpm_restart',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
