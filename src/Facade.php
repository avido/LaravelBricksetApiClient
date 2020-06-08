<?php
namespace Avido\LaravelBricksetApiClient;

class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BricksetApiClient::class;
    }
}
