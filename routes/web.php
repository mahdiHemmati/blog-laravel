<?php
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/{id}', function ($id) {
    return 'This is user '.$id;
});*/

//php artisan route:list -> show all of route

Route::prefix('test')->group(function (){
//    Route::get('gr', function () {
//       return route('posts.update', ['post' => 44]);
//    }),
    Route::get('dc', function () {
        //return Verta::getJalali(2021,3,20);
        return Request::ip();
    });
    Route::get('grs', function() {
        return Str::random(60);
    });
});

Route::get('test2', function () {
    $data = Request::session()->all();
    return $data;

});


Route::get('s', function () {
    $data = Request::session()->all();
    dd($data);

});

Route::get('/','PagesController@index');
Route::get('/about','PagesController@about');
Route::get('/services','PagesController@services');


Route::resource('posts' , 'PostsController')->middleware(\App\Http\Middleware\ViewThrottleMiddleware::class);
//

Route::post('/comment/store', 'CommentController@store')->name('comments.store');

Route::post('/like', 'PostsController@likePost')->name('like');


Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::get('/posts/tags/category/{tag}/{category}','PostsController@searchByTag');
Route::get('/posts/tags/search/','PostsController@search');
Route::get('/posts/category/{category}','PostsController@searchByCategory');