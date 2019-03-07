<?php

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
// Auth::routes();

// admin route

Route::get("/admin", 'AdminController@index')->name('admin');

// Authentication routes
Route::get('login', 'Auth\AuthController@showLoginForm')
      ->name('login');

Route::post('login', 'Auth\AuthController@login');

Route::post('logout', 'Auth\AuthController@logout')
      ->name('logout');

// Registration routes
Route::get('register', 'Auth\AuthController@showRegistrationForm')
      ->name('register');
Route::post('register', 'Auth\AuthController@register');

// sociatlite routes
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');

Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

// Home page route

Route::get('/', 'PagesController@index')->name('home');

// Password routes

// Password reset routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
    ->name('password.request');

Route::post('password/email', 'Auth\AuthController@sendResetLinkEmail');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');

Route::post('password/reset', 'Auth\AuthController@reset');

// test route
Route::get('test', 'TestController@index')->middleware('auth');

// Route::get('/home', 'HomeController@index')->name('home');

// widget routes
Route::get('widget/create', 'WidgetController@create')->name('widget.create');
Route::get('widget/{widget}-{slug?}', 'WidgetController@show')->name('widget.show');
Route::resource('widget', 'WidgetController', ['except' => ['show', 'create']]);

// terms route
Route::get('terms-of-service', 'PagesController@terms');

// privicy route
Route::get('privacy', 'PagesController@privacy');

// Profile
Route::get('show-profile', 'ProfileController@showProfileToUser')
      ->name('show-profile');
Route::get('determine-profile-route', 'ProfileController@determineProfileRoute')
      ->name('determine-profile-route');
Route::resource('profile', 'ProfileController');

// users
Route::resource('user', 'UserController');

// setting
Route::get('settings', 'SettingsController@edit');

Route::post('settings', 'SettingsController@update')
      ->name('user-update');

// marketing-image
Route::resource('marketing-image', 'MarketingImageController');

// Api Routes
Route::get('api/widget-data', 'ApiController@widgetData');

Route::get('api/marketing-image-data', 'ApiController@marketingImageData');

// Chat routes
Route::get('/chat-messages', 'ChatController@getMessages')
      ->middleware('auth');

Route::post('/chat-messages', 'ChatController@postMessages')
      ->middleware('auth');

Route::get('/chat', 'ChatController@index')
      ->middleware('auth');

Route::get('/username', 'UsernameController@show')
      ->middleware('auth');

// Custom Validattor & Dependent Dropdown
Route::get('api/category-data', 'ApiController@categoryData');

Route::get('api/subcategory-data', 'ApiController@subcategoryData');

// Category route
Route::resource('category', 'CategoryController');

// Subcategory route
Route::resource('subcategory', 'SubcategoryController');

// Lession
Route::get('lesson/create', 'LessonController@create')
      ->name('lesson.create');

Route::get('lesson/{lesson}-{slug?}', 'LessonController@show')
      ->name('lesson.show');

Route::resource('lesson', 'LessonController', ['except' => ['show', 'create']]);

Route::get('api/lesson-data', 'ApiController@lessonData');
