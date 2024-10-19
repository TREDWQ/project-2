<?php


use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\UserController;
use App\Models\lesson;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\API\RelationshipController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\API\LoginController;





Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => '/v1'], function () {

    Route::apiResource('lessons', LessonController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('tags', TagController::class);


    Route::any('lesson', function () {
        $message = 'please make sure to update your code to use the newer version of our API. 
        You should  us lessons instead of lesson';

        return Response::json(
            $message
       ,404 );
    });

    //Route::redirect('lesson', 'lessons');


    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::get('users/{id}/lessons', [RelationshipController::class, 'userLessons']);
    Route::get('lessons/{id}/tags', [RelationshipController::class, 'lessonTags']);
    Route::get('tags/{id}/lessons', [RelationshipController::class, 'tagLessons']);
    
});

// Route::domain('{account}.mypp.com')->group(function(){
//         Route::get('user/{id}', function ($account, $id){
//             //
//         });
//     });

//     Route::get('lessons/{lesson:slug}', function ($lesson){
//         return $lesson;
//     });

//     Route::fallback(function() {
//         //
//     });