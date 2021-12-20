# Install Package
##### 1 - composer require mrmarchone/repositories:dev-master
##### 2 - php artisan create:repo NameOfYourRepo
### if you want service with repository
##### php artisan repository:create NameOfYourRepo --service

### For laravel <= 5.4
##### add this "\Mrmarchone\Repositories\RepositoriesServiceProvider::class" to providers in app file in config folder
