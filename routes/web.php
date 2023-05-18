<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/blog')->name('blog.')->group(function () {
    Route::get('/', function () {
        $posts =  Post::find(1);
        dd($posts);

        return $posts;
        // return [
        //     "link" => \route('blog.show', ['slug' => 'article', 'id' => 13]),
        // ];
    })->name('index');
    
    Route::get('/{slug}-{id}', function (String $slug, String $id, Request $request) {
            return [
                "slug" => $slug,
                "id" => $id,
                "name" => $request->input('name', 'John Doe'),
            ];
    })->where([
        "slug" => '[a-z0-9\-]+',
        "id" => '[0-9]+',
    ])->name('show');
});
