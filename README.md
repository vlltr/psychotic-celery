#  psychotic-celery

Laravel parking API

##  Requirements

If you don't want to use [Docker](https://www.docker.com/), the best way to setup the project is to use [Homestead](https://laravel.com/docs/homestead) or [Laragon](https://laragon.org/).

-  [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)

- PHP 8.1+

-  [Composer](https://getcomposer.org/)

-  [MySQL](https://www.mysql.com/)

##  Development Environment (No Docker)

1. Clone Project

```bash
git clone git@github.com:vlltr/psychotic-celery.git
cd psychotic-celery
```

2. Install dependencies

```bash
composer install
```

3. Create .ENV

```bash
cp .env.example .env
```

4. Generate app key

```bash
php artisan key:generate
```

5. Run migrations

```bash
php artisan migrate --seed
```

6. Run application

```bash
php artisan serve
```

Once you have started, application will be accessible in web browser at http://localhost:8000

##  Development Environment (Docker use Sail)

It is recommended to run all from the WSL.

1. Clone Project

```bash
git clone git@github.com:vlltr/psychotic-celery.git
cd psychotic-celery
```

2. Download dependencies

```bash
docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd):/var/www/html" \
-w /var/www/html \
laravelsail/php81-composer:latest \
composer install --ignore-platform-reqs
```

3. Configuring a shell alias

```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

4. Create .ENV

```bash
cp .env.example .env
```

5. To start all of the Docker containers

```bash
sail up
```

or start Sail in "detached" mode

```bash
sail up -d
```

Once the application's containers have been started, you may access the project in web browser at http://localhost.

  

6. Generate app key

```bash
sail artisan key:generate
```

7. Run migrations

```bash
sail artisan migrate --seed
```
##  Executing Commands

```bash
# Running Artisan commands locally (No Docker)...
php artisan queue:work
# Running Artisan commands with Laravel Sail (Docker)...
sail artisan queue:work
```

##  Run Tests

  
```bash
# Running Artisan commands locally (No Docker)...
php artisan test
# Running Artisan commands with Laravel Sail (Docker)...
sail artisan test
```