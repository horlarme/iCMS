<?php
//The Main Application which is accessible for the user/end user
Route::prefix('/')->group(function () {
//    Home page link
    Route::get('', function () {
        echo "<a href='" . route('login') . "'>Login</a>";
    });
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => '/advance', 'middleware' => 'auth'], function () {

    Route::get('', 'PageController@index')->name('dashboard');

    Route::get('storage', 'PageController@storage')->name('storage');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('', 'UserController@index')->name('profile');
        Route::get('/edit', 'UserController@edit')->name('profile.edit');
    });

    //Category
    Route::group(['prefix' => 'category'], function () {
        Route::get('', 'CategoryController@index')->name('categories');
        Route::get('/{name}', 'CategoryController@view')->name('category.view');
        Route::get('/new', 'CategoryController@new')->name('category.new');
        Route::get('/deleted', 'CategoryController@deleted')->name('category.deleted');
        Route::get('/{name}?action=edit', 'CategoryController@edit')->name('category.edit');
        Route::get('/{name}?action=delete', 'CategoryController@edit')->name('category.delete');
    });
    //Category

    //Pages
    Route::group(['prefix' => 'page'], function () {
        Route::get('', 'PagesController@index')->name('pages');
        Route::get('/{name}', 'PagesController@view')->name('page.view');
        Route::get('/new', 'PagesController@new')->name('page.new');
        Route::get('/deleted', 'PagesController@deleted')->name('page.deleted');
        Route::get('/{name}?action=edit', 'PagesController@edit')->name('page.edit');
        Route::get('/{name}?action=delete', 'PagesController@edit')->name('page.delete');
    });
    //Pages

    //Post
    Route::group(['prefix' => 'post'], function () {
        Route::get('/new', 'PostController@newPost')->name('post.new');
        Route::post('/new', 'PostController@create')->name('post.create');
//        Route::get('/trash', 'PostController@new')->name('post.deleted');
//        Route::get('/scheduled', 'PostController@new')->name('post.scheduled');
        Route::get('/{type}', 'PostController@index')->name('post.view');
    });
    //Post

    //Settings
    Route::group(['prefix' => 'setting'], function () {
        Route::get('/{setting}', 'AppSettingController@index')->name('setting');
        Route::post('/{setting}', 'AppSettingController@update')->name('save.setting');
    });
    //Settings
});

/**
 * Possible Mistyped URLs
 */
Route::any('dashboard', function (){
    //Redirecting Users to the administration page
    return redirect()
        ->route('dashboard');
});