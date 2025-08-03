# Scoreboard
A simple scoreboard application built with Laravel, designed to track and display the highest scores per skill and per player. Build as requested in the assignment file [OPDRACHT.md](OPDRACHT.md). Thoughts and considerations are documented in the assignment elaboration file [OPDRACHT-UITWERKING.md](OPDRACHT-UITWERKING.md).

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
```php artisan scores:get-highest-per-player {player_id}```

## Testing
Run the tests using:
```php artisan test```

## Improvements
in the branch `improvements`, I have added a few improvements to the original code to further elaborate on the assignment. 
