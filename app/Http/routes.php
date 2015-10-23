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

use Hateoas\HateoasBuilder;
$app->get('/', function(){
    return response()->json([
        '_links' => [
            '_self' => [ 'href' => url() ],
            'scientists' => [ 'href' => route('scientists') ],
            'theories' => [ 'href' => route('theories') ]
        ]
    ]);
});

$app->get('scientists', [ 'as' => 'scientists', 'uses' => 'ScientistController@index']);
$app->post('scientists', [ 'as' => 'scientists_create', 'uses' => 'ScientistController@store']);
$app->get('scientists/{id}', [ 'as' => 'scientist', 'uses' => 'ScientistController@show']);
$app->get('scientists/{id}/theories', [ 'as' => 'scientist_theories', 'uses' => 'ScientistController@theories']);

$app->get('theories', [ 'as' => 'theories', 'uses' => 'TheoryController@index']);
$app->get('theories/{id}', [ 'as' => 'theory', 'uses' => 'TheoryController@show']);
