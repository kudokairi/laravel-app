#!/bin/bash

set -eux

cd ~/laravel-app/laravel
php artisan migrate --force
php artisan config:cache