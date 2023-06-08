@servers(['production' => [$user .'@'. $host]])

@setup
    $repo = $repo;
    $username = (isset($user)) ? $user : 'ubuntu';
    $branch = (isset($branch)) ? $branch : 'master';
    $backupDir = '/var/sources';
    $release = date('ymdhis');
    $newReleaseDir = $backupDir ."/". $release;
    $liveDir = '/var/www/html';
    $branch = 'master';
    $liveEnv = $liveDir ."/.env";
    $liveStorage = $liveDir ."/storage";
@endsetup

@story('deploy')
    clone-repo
    install-dependencies
    update-symlink
    migrate-database
    restart-queues
    optimize
    clean_old_releases
    live
@endstory


@task('clone-repo', ['on' => ['production']])
    echo "Cloning repository..."
    [ -d {{ $backupDir }} ] || mkdir {{ $backupDir }}
    git clone -b {{ $branch }} "{{ $repo }}" {{ $newReleaseDir }}
@endtask

@task('install-dependencies', ['on' => ['production']])
    echo "Composer Install"
    cd {{ $newReleaseDir }}
    composer install --no-interaction --no-dev --no-scripts - q -o
@endtask

@task('update-symlink', ['on' => ['production']])
    echo "Update-Symlink!"
    rm -rf {{ $newReleaseDir }}/storage
    echo "Update-symlink: linking .env file"
    ls -nfs {{ $liveEnv }} {{ $newReleaseDir }}/.env
    echo "Update-symlink: linking storage directory"
    ls -nfs {{ $liveStorage }} {{ $newReleaseDir }}/storage
@endtask

@task('migrate-database', ['on' => ['production']])
    echo "Migrating Database..."
    cd {{ $newReleaseDir }}
    php artisan down
    php artisan migrate --force
    php artisan up
@endtask

@task('restart-queues', ['on' => ['production']])
    echo "Restarting Queues..."
    cd {{ $newReleaseDir }}
    php artisan queue:restart
@endtask

@task('optimize', ['on' => ['production']])
    echo "optimizing..."
    cd /var/www/html
    php artisan cache:clear
    php artisan route:clear
    php artisan config:clear
    php artisan view:clear
    php artisan optimize
@endtask

@task('live', ['on' => ['production']])
    echo "Releasing to live..."
    ln -nfs {{ $newReleaseDir }} {{ $liveDir }}
@endtask

@task('clean_old_releases', ['on' => ['production']])
    # Delete All but the 3 most recent releases
    echo "cleaning old releases" 
    cd {{ $backupDir }}
    ls -dt {{ $backupDir }}/* | tail -n +4 | xargs -d "\n" rm -rf
@endtask