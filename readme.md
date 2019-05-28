
## TODO TASK APP

## Install
- Create your database and then update the following fields in the .env file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo
DB_USERNAME=root
DB_PASSWORD=Christ
```

- Then
```
	php artisan migrate
	php artisan db:seed
	php artisan serve --port=8888
```




