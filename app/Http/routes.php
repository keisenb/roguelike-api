<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->welcome();
});


/* Adds the /api prefix to the routes inside of this function*/
$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function () use ($app) {

    //powerups
    $app->get('/powerups', 'PowerUpController@GetPowerUps');
    $app->get('/powerups/{id}', 'PowerUpController@GetPowerUp');

    //armors
    $app->get('/armors', 'ArmorController@GetArmors');
    $app->get('/armors/{id}', 'ArmorController@GetArmorById');

    //character classes
    $app->get('/classes', 'CharacterClassController@GetClasses');
    $app->get('/classes/{id}', 'CharacterClassController@GetClassById');

    //weapons
    $app->get('/weapons', 'WeaponController@GetWeapons');
    $app->get('/weapons/{id}', 'WeaponController@GetWeaponById');

});
