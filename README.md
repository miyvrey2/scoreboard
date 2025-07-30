# Scoreboard

## Installation
1. Clone the repository:
   ```git clone git@github.com:miyvrey2/scoreboard.git```
2. Change directory:
   ```cd scoreboard```
3. Install dependencies:
   ```composer install```
4. Copy the `.env.example` file to `.env`:
   ```cp .env.example .env```
5. Generate the application key:
   ```php artisan key:generate```
6. Run the migrations:
   ```php artisan migrate```
7. (Optional) Seed the database with sample data:
   ```php artisan db:seed```

## Usage
To see the highest scores per skill, run the following command:
```php artisan scores:get-highest-per-skill```

To see the scores per player, run:
```php artisan scores:get-highest-per-player```
