<?php

use App\Http\Controllers\Api\Authcontroller;
use App\Http\Controllers\Api\Notecontroller;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/signup', [Authcontroller::class,'register']);

Route::post('/login', [Authcontroller::class,'login']);

//Маршруты для работы с заметками

/*Route::get('/notes', function (Request $request)
{
    return $request;
})->middleware('auth:sanctum');

Route::get('notes/{note}', function(Request $request)
{
    return $request;
});

Route::post('/notes', function (Request $request)
{
    $note = new Note();
    $note->title = "Заметка";
    $note->body = "Заметка";
    $note->image = "Картинка";
    $note->user_id = 1;
    $note->save();
    return $request;
})->middleware('auth:sanctum');

Route::delete('notes/{note}', function (Request $request)
{
    return $request;
})->middleware('auth:sanctum');

Route::put('notes/{note}', function(Request $request)
{
    return $request;
})->middleware('auth:sanctum');*/

Route::apiResource('notes', Notecontroller::class)->middleware('auth:sanctum');