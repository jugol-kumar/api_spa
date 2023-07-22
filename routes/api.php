<?php

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:sanctum'])->group(function (){
   Route::get('users', [\App\Http\Controllers\UserController::class, 'users']);

   Route::get('tasks/{auth_id}', [\App\Http\Controllers\TaskController::class, 'userTasks']);
   Route::get('tasks-single/{task_id}', [\App\Http\Controllers\TaskController::class, 'singleTask']);
   Route::post('assigned-user', [\App\Http\Controllers\TaskController::class, 'assignedUser']);

});
