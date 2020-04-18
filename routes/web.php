<?php



Route::get('/', 'InstrumentsController@index')->name('instruments.index');;
// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');




Route::group(['middleware' => ['auth']], function () {
    Route::resource('user_profiles', 'UserProfilesController', ['only' => ['index', 'show', 'create', 'store', 'edit', 'update',]]);
    Route::post('user_profiles/image_upload', 'UserProfilesController@image_upload')->name('user_profiles.image_upload');
    Route::resource('instruments', 'InstrumentsController', ['only' => ['show', 'create', 'store', 'destroy', 'edit', 'update']]);
    Route::post('instruments/image_upload', 'InstrumentsController@image_upload')->name('instruments.image_upload');;
    Route::resource('comments', 'CommentsController', ['only' => ['store', 'destroy',]]);
    
    Route::group(['prefix' => 'user_profiles/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user_profile.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user_profile.unfollow');
        Route::get('followings', 'UserProfilesController@followings')->name('user_profiles.followings');
        Route::get('followers', 'UserProfilesController@followers')->name('user_profiles.followers');
    });
    
    Route::group(['prefix' => 'instruments/{id}'], function () {
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
         Route::get('favorites', 'UserProfilesController@favorites')->name('user_profiles.favorites');
    });
    
});
