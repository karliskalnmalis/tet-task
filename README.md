## How to initialize project and get everything running

1. Make sure You are in the project's root directory
1. Execute `composer install` to install vendor dependencies
1. Execute `cp .env.example .env`
1. Replace the DB credentials inside `.env` file with Your local configuration
1. Execute command `php artisan migrate`, to run migrations
1. Execute command `php artisan currencies:import`, to parse and save all necessary information to the "currencies" table
1. Execute `php artisan serve`, to start Laravel's development server