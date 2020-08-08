
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your applicatio;;n. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function (){
//     return view('welcome');
// });



Auth::routes();

//---- Frontend Route ----//
Route::get('/', 'Frontend\frontendController@index')->name('home');
Route::get('/contact', 'Frontend\frontendController@contact')->name('contact');

Route::group(['middleware'=>'auth'], function(){
Route::get('/fevourite/list/{id}', 'Frontend\fevouriteController@fevouriteList')->name('fevourite.list');
});

Route::post('/comment/{post_id}', 'Frontend\commentController@commentStore')->name('comment.store');

Route::get('/posts', 'Frontend\postsController@viewAllPost')->name('all.posts');
Route::get('/category/{slug}', 'Frontend\postsController@categoryByPost')->name('category.posts');
Route::get('/tag/{slug}', 'Frontend\postsController@tagByPost')->name('tag.posts');
Route::get('/search', 'Frontend\postsController@searchPost')->name('search.post');

Route::get('/post/{slug}','Frontend\singPostController@postSingleView')->name('single.post.view');

//---- Admin Route ---//
Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function(){

	Route::get('/dashboard', 'dashboardController@index')->name('dashboard');

	Route::get('/author', 'authorController@index')->name('author.index');
	Route::delete('/author/{id}', 'authorController@destroy')->name('author.destroy');

	Route::get('/subscriber', 'subscriperController@index')->name('subscriber.index');
	Route::post('/subscriber/store', 'subscriperController@store')->name('subscriber.store');
	Route::delete('/subscriber/destory/{id}', 'subscriperController@destroy')->name('subscriber.destroy');

    Route::get('/profile', 'userProfileController@index')->name('user.profile');
    Route::put('/profile/update', 'userProfileController@updateProfile')->name('profile.update');
    Route::post('/password/update', 'userProfileController@passwordUpdate')->name('password.update');

	Route::resource('tag','tagController');
	Route::resource('category','categoryController');
	Route::resource('post','postController');

	Route::get('/post/approve/list','postController@postApproveList')->name('post.approve.list');
	Route::put('/post/approve/{id}','postController@postApprove')->name('post.approve');

	Route::get('/favourite','favouriteController@index')->name('favourite.list');

	Route::get('/comments', 'commentController@index')->name('comment.index');
	Route::delete('/comments/{id}', 'commentController@destroy')->name('comment.destroy');
});

//---- Author Route ---//
Route::group(['as'=>'author.','prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']], function(){

	 Route::get('/profile', 'userProfileController@index')->name('user.profile');
    Route::put('/profile/update', 'userProfileController@updateProfile')->name('profile.update');
    Route::post('/password/update', 'userProfileController@passwordUpdate')->name('password.update');

	Route::get('/dashboard', 'dashboardController@index')->name('dashboard');
	Route::resource('/post','postController');

	Route::get('/favourite','favouriteController@index')->name('favourite.list');

	Route::get('/comments', 'commentController@index')->name('comment.index');
	Route::delete('/comments/{id}', 'commentController@destroy')->name('comment.destroy');
});

// composer Route * when you want to access all page//
View::composer('layouts.Frontend.partials.footer', function($view){
    $categories = App\Models\category::all();
    $view->with('categories', $categories);
});
