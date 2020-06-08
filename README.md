# Laravel Brickset Api Client
Laravel API Client for https://brickset.com/tools/webservices/v3
## Installation
`composer require avido/laravel-brickset-api-client`

## Optional Push configuration
`php artisan vendor:publish`

## Configuration
Edit your .env file and add the following variables:\
`BRICKSET_APIKEY`
`BRICKSET_USERNAME`
`BRICKSET_PASSWORD`

Alternatively you can also edit `/config/brickset-api.php` (if you published the configuration)

## Facade
`BricksetApiClient`

## Need to set apikey / user / password programmatically?
```
$client = new BricksetApiClient($apiKey, $username, $password);
```
