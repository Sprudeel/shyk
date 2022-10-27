#
![](https://lchsd.ch/images/shyk_logo.png)
#

## Start Local Development

### Install dependencies
```php
composer install # backend dependencies
npm install # frontend dependencies
```

### Start sail
```
./vendor/bin/sail up -d
```
or configure an shell alias
```php
alias sail='./vendor/bin/sail'

# and then run it
sail up -d
```
### Start the frontent
```php
npm run dev
```

### Migrate Database and Seed it
```php
sail artisan migrate:fresh --seed
```

#### To Login with an Admin Account use 'sprudeel@example.com' as the mail and 'password' as the password.

Now you're up and running!


