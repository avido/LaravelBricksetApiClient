# Laravel Brickset Api Client
[![Build Status](https://travis-ci.org/avido/LaravelBricksetApiClient.svg?branch=master)](https://travis-ci.org/avido/LaravelBricksetApiClient)
[![Latest Stable Version](https://poser.pugx.org/avido/laravel-brickset-api-client/v/stable)](https://packagist.org/packages/avido/laravel-brickset-api-client)
[![Total Downloads](https://poser.pugx.org/avido/laravel-brickset-api-client/downloads)](https://packagist.org/packages/avido/laravel-brickset-api-client)
[![License](https://poser.pugx.org/avido/laravel-brickset-api-client/license)](https://packagist.org/packages/avido/laravel-brickset-api-client)
[![composer.lock](https://poser.pugx.org/avido/laravel-brickset-api-client/composerlock)](https://packagist.org/packages/avido/laravel-brickset-api-client)





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
