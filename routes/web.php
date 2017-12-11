<?php
//The Main Application which is accessible for the user/end user
Route::prefix('/')->group(function () {
//    Home page link
    Route::get('', [
        'as' => 'home',
        'uses' => 'PageController@home'
    ]);

    Route::get('blog/{postURL}', 'PageController@viewPost')->name('post');

    Route::get('{pageTitle}', 'PageController@viewPage')->name('page');

    Route::get('category/{categoryName}', 'PageController@byCategory')->name('category');

    Route::get('tag/{tag}', 'PageController@byTag')->name('tag');
});


Route::group(['prefix' => '/advance'], function () {

    Auth::routes();

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/dashboard', 'PageController@index')->name('dashboard');

        Route::get('storage', 'PageController@storage')->name('storage');

        Route::group(['prefix' => 'profile'], function () {
            Route::get('', 'UserController@index')->name('profile');
            Route::get('/edit', 'UserController@edit')->name('profile.edit');
        });

        //Category
        Route::group(['prefix' => 'category'], function () {
            Route::get('', 'CategoryController@index')->name('categories');
            Route::get('/new', 'CategoryController@create')->name('category.new');
            Route::post('/new', 'CategoryController@process')->name('category.create');
            Route::get('/{category}', 'CategoryController@edit')->name('category.edit');
            Route::post('/{category}', 'CategoryController@update')->name('category.update');
            Route::delete('/{category}', 'CategoryController@delete')->name('category.delete');
        });
        //Category

        //Pages
        Route::group(['prefix' => 'page'], function () {
            Route::get('', 'PagesController@index')->name('pages');
            Route::get('/new', 'PagesController@newPage')->name('page.new')->middleware('restrict');
            Route::post('/new', 'PagesController@create')->name('page.create')->middleware('restrict');
            Route::get('/deleted', 'PagesController@deleted')->name('page.deleted');
            Route::get('/{id}/edit', 'PagesController@edit')->name('page.edit');

            Route::post('/{id}/edit', 'PagesController@update')->name('page.update')->middleware('restrict');
            Route::delete('/{id}', 'PagesController@delete')->name('page.delete');
            Route::get('/{id}', 'PagesController@restore')->name('page.restore')->middleware('restrict');
            Route::delete('/delete/{id}', 'PagesController@deleteDeleted')->name('page.deleteDeleted')->middleware('restrict');
        });
        //Pages

        //Post
        Route::group(['prefix' => 'post'], function () {
            Route::get('/new', 'PostController@newPost')->name('post.new');
            Route::post('/new', 'PostController@create')->name('post.create');
            Route::get('/trash', 'PostController@deleted')->name('post.deleted');
            Route::get('/published', 'PostController@index')->name('post.view');
            Route::get('/{id}/edit', 'PostController@edit')->name('post.edit');

            Route::post('/{id}/edit', 'PostController@update')->name('post.update');
            Route::delete('/{id}', 'PostController@delete')->name('post.delete');
            Route::get('/{id}', 'PostController@restore')->name('post.restore');
            Route::delete('/delete/{id}', 'PostController@deleteDeleted')->name('post.deleteDeleted');

        });
        //Post

        //Settings
        Route::group(['prefix' => 'setting'], function () {
            Route::get('/{setting}', 'AppSettingController@index')->name('setting');
            Route::post('/{setting}', 'AppSettingController@update')->name('save.setting');
        });
        //Settings
    });

});

/**
 * Possible Mistyped URLs
 */
Route::any('dashboard', function () {
    //Redirecting Users to the administration page
    return redirect()
        ->route('dashboard');
});