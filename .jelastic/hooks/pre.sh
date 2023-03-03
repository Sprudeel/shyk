#! /bin/bash

echo "Starting Deployment"

php artisan down --render="errors::503"

echo "Application now in Maintenance Mode"
