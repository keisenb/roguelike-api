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
    return redirect('/api/documentation');
});


/* Adds the /api prefix to the routes inside of this function*/
$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function () use ($app) {

    //auth
    $app->post('/login', 'AuthController@login');
    $app->post('/register', 'AuthController@register');

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

    //class-items
    $app->get('/classitems/{id}', 'ClassItemController@ItemsFromClass');
    $app->get('/itemclass/{id}', 'ClassItemController@ClassOfItem');
});

//authenticated endpoints
$app->group(['middleware' => ['jwt.auth:api'], 'prefix' => 'api', 'namespace' => 'App\Http\Controllers'], function() use ($app)
{
    //test
    $app->get('/test', function() {
        return response()->json([
            'message' => 'Hello World!',
        ]);
    });

    //User
    $app->get('/user', 'UserController@GetUser');
    $app->put('/user', 'UserController@UpdateUser');

    //logout
    $app->get('/logout', 'AuthController@logout');

    //character history
    $app->get('/characters/history', 'CharacterHistoryController@GetCharacterHistories');
    $app->get('/characters/history/{id}', 'CharacterHistoryController@GetCharacterHistoryById');
    $app->post('/characters/history', 'CharacterHistoryController@CreateCharacterHistory');
    $app->put('/characters/history/{id}', 'CharacterHistoryController@UpdateCharacterHistory');

    //levels
    $app->get('/levels', 'LevelController@GetLevels');
    $app->get('/levels/{id}', 'LevelController@GetLevelById');
    $app->post('/levels', 'LevelController@CreateLevel');

    //characters
    $app->post('/characters', 'CharacterController@CreateCharacter');
    $app->get('/characters/{id}', 'CharacterController@GetCharacterById');
    $app->put('/characters/{id}', 'CharacterController@UpdateCharacter');

    //powerups
    $app->post('/powerups', 'PowerUpController@PickedUpPowerUp');

    //messages
    $app->get('/messages', 'MessageController@GetUserMessages');
    $app->post('/messages', 'MessageController@SendMessage');

    //friends
    $app->get('/friends', 'FriendController@GetFriends');
    $app->delete('/friends', 'FriendController@DeleteFriend');
    $app->post('/friends', 'FriendController@AddFriend');
});
