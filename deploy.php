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


// Writable dirs by cron user 
set('cron_user', 'adam');
set('cron_writable_dirs', [
    'data',
    'public/panels',
]);


// Hosts

host('dinoremix.definingterms.com')
    ->user('deployer')
    ->forwardAgent(true)
    ->stage('production')
    ->set('deploy_path', '/var/www/dinoremix');
    

// Tasks

task('deploy:writable_cron', function () {
    $user = get('cron_user');
    $dirs = join(' ', get('cron_writable_dirs'));

    if (empty($dirs)) {
        return;
    }

    cd('{{release_path}}');

    // Change owner.
    // -R   operate on files and directories recursively
    // -L   traverse every symbolic link to a directory encountered
    run("sudo chown -RL $user $dirs");
});

task('deploy:fpm_restart', function () {
    $output = run('sudo service php7.0-fpm restart');
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
    'deploy:writable_cron',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:fpm_restart',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
