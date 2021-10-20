<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\NewsApiController;

Route::prefix('v1')->group(function () {  
    Route::get(
        'news/article/{id}', 
        [NewsApiController::class, 'showArticle']
    )->where(['id' => '[0-9]+']); 

    Route::get(
        'news/author/{authorId}/{pageNum?}', 
        [NewsApiController::class, 'showByAuthor']
    )->where(['authorId'=> '[0-9]+','pageNum' => '[0-9]+']); 

    Route::get(
        'news/search/{pageNum?}', 
        [NewsApiController::class, 'showBySearch']
    )->where(['pageNum' => '[0-9]+']); 

    Route::get(
        'news/{pageNum?}', 
        [NewsApiController::class, 'show']
    )->where(['pageNum' => '[0-9]+']); 
});