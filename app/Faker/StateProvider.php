<?php
namespace App\Faker;
use Faker\Provider\Base;
class StateProvider extends Base
{
    protected static $names = [
        'Akwa Ibom',
        'Bayelsa',
        'Cross River',
        'Rivers',
    ];
    
    public function states(): string
    {
        return static::randomElement(static::$names);
    }
}