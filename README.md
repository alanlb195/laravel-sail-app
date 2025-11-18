# Laravel Sail - Template Project


## Startup
```
git clone [repo_name]

cd [project_name]

composer install

cp .env.example .env
```

How to start the project:

```bash
docker compose up -d
```

After that, you can check the status of the project whithe the next url:
```
http://localhost/api/test
```


how to execute commands?

example:

```
./vendor/bin/sail php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```