<?php
Route::get('/', 'WelcomeController@index');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup','Auth\RegisterController@register')->name('signup.post');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout','Auth\LoginController@logout')->name('logout.get');

Route::get('ranking/read','RankingController@read')->name('ranking.read');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        Route::get('want_items', 'UsersController@want_items')->name('users.want_items');
        Route::get('read_items', 'UsersController@read_items')->name('users.read_items');
        Route::get('settings','UsersController@settings')->name('users.settings');
    });
    
    Route::resource('items', 'ItemsController', ['only' => ['create', 'show']]);
    Route::post('want', 'ItemUserController@want')->name('item_user.want');
    Route::delete('want', 'ItemUserController@dont_want')->name('item_user.dont_want');
    Route::delete('read', 'ItemUserController@dont_read')->name('item_user.dont_read');
    Route::post('read', 'ItemUserController@read')->name('item_user.read');  
    Route::resource('reviews', 'ReviewsController', ['only' => ['store', 'destroy']]);
    Route::post('upload', 'UsersController@upload')->name('users.upload');
});

Auth::routes();