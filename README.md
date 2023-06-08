# Laravel Tailwind CSS Sample File Upload
Laravel Tailwind CSS Sample File Upload - Code to show how to do upload and delete operations with the file using Tailwind CSS with Laravel

## Run Application

Step 1: 

Clone the project

```bash
  git clone 
```
Go to the project directory

```bash
  cd laravel-tailwindcss-sample-fileupload
```

Step 2: Install dependencies

```bash
  composer install
```


Step 3: Make .env file from .env.example

```bash
  cp .env.example .env
```

Step 4: You need DB connection information to your .env file

`DB_HOST`

`DB_PORT`

`DB_DATABASE`

`DB_USERNAME`

`DB_PASSWORD`

Step 5 run migrations

```bash
  php artisan migrate
```

Step 6 run npm

```bash
  npm i
```

Step 7 Update CSS

```bash
  npx tailwindcss -o public/css/app.css
```

Step 8 link storage

```bash
  php artisan storage:link
```

Step 9: Start the server

```bash
  php artisan serve
```