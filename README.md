## If Browser is not updating View
### Run this command
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear



## Seeding particular file
# php artisan db:seed --class=UsersTableSeeder            Main command is this
# php artisan migrate:refresh --seed --class=UsersTableSeeder      
