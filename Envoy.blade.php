@servers(['med-user' => ['root@47.93.158.148']])

@task('deploy', ['on' => 'med-user'])
    cd /home/www/oshop

    git pull origin master

    composer install

    php artisan migrate
@endtask

@task('pull', ['on' => 'med-user'])
    cd /home/www/oshop

    git pull origin master
@endtask

@task('seed', ['on' => 'med-user', 'confirm' => true])
    cd /home/www/oshop

    php artisan db:seed
@endtask