#! /bin/bash

# Navigate to directory
cd ..
cd ..
cd www/webroot/ROOT

# install all composer dependencies
composer install --optimize-autoloader --no-dev
composer update

# install nodejs
curl -sk https://nodejs.org/dist/v17.9.1/node-v17.9.1-linux-x64.tar.xz | tar -xJC $HOME --strip-component=1
rm -f $HOME/{CHANGELOG.md,LICENSE,README.md}
chmod +x $HOME/bin/*
echo "export PATH=$PATH:$HOME/bin:" >> $HOME/.bash_profile
. $HOME/.bash_profile

# install all npm dependencies
npm install

# build frontend
export NODE_OPTIONS=--max-old-space-size=8192
npm run build

# optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Exit Maintenance Mode
php artisan up

# Deployment finished
echo "Deployment finished!"
