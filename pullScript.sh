#!/bin/bash
echo "Script pull started"
composer install
read -p "Do you want to refresh ALL your database ? (/!\ data inserted will be remove /!\) : y / N " -n 1 -r
echo    # (optional) move to a new line
if [[ $REPLY =~ ^[Yy]$ ]]
then
    # do dangerous stuff
    php artisan migrate:fresh
    php artisan migrate --force
fi
if [[ $REPLY =~ ^[Nn]$ ]]
then
    # do dangerous stuff
    php artisan migrate --force
fi

read -p "Do you want to generate fake data ? : y / N " -n 1 -r
if [[ $REPLY =~ ^[Yy]$ ]]
then
    php artisan db:seed --class=AnimationSeeder
    php artisan db:seed --class=UserSeeder
    php artisan db:seed --class=DepartmentSeeder
    php artisan db:seed --class=CategorySeeder
fi

php artisan clear-compiled
php artisan view:clear
php artisan config:clear
php artisan route:cache
php artisan optimize:clear
npm install
npm run dev
echo "Script pull finished"
