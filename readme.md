# DNS-registeration

#### in our website, you can register your domain name and get some services but before that, we should verify your domain name.
#### every user can register n domain and for each domain can register n TXT records.
#### 5 min after DNS record registered our service will lookup your DNS to find your TXT record.
#### if any of them find in your domain would be approved.
--------
# How to Run With Docker
* after clone project from github, set permissions on the project directory:
```sudo chown -R $USER:$USER ~/application```
* install composer:
```docker run --rm -v $(pwd):/app composer install```
* create new env:
```cp .env.example to .env```

* config your Database ENV and set Queue in database:
```
db-host=db
db-username=YOUR DB USERNAME
db-password=YOUR DB Password
MYSQL_ROOT_PASSWORD = YOUR DB ROOT PASSWORD
queue connection = database
```
* start all of the containers:
```docker-compose up -d```

* set the application key for the Laravel application and cache new config:

```docker-compose exec app php artisan key:generate```
```docker-compose exec app php artisan config:cache```
```docker-compose exec app php artisan cache:clear```
* grant the user account that will be allowed to access database:
```docker-compose exec db bash```
```mysql -u root -p```
```GRANT ALL ON YOURDBNAME.* TO 'laraveluser'@'%' IDENTIFIED BY 'your_laravel_db_password';```
* create DB:
```docker-compose exec app php artisan migrate```
* listen to queue:
```docker-compose exec app php artisan queue:work```
* you can access now:
```http://your_server_ip```
