#
![](https://lchsd.ch/images/shyk_logo.png)
#

## Start the Project

First you need to install all the dependencies
```php
composer install # backend dependencies
npm install # frontend dependencies
```

start the backend type
```
./vendor/bin/sail up
```
or configure an shell alias
```php
alias sail='./vendor/bin/sail'

# and then run it
sail up
```
then start the frontent
```php
npm run dev
```

Now you're up and running!

## Useful Commands

Migrate Database
```php
sail artisan migrate
```

Seed the Database
```php
sail artisan db:seed
```