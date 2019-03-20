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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/dashboard', 'Backend\AdminController@index')->name('admin.dashboard');


// Admin user Authenticate

// Authentication Routes...
    Route::get('admin/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login', 'Backend\Auth\LoginController@login')->name('admin.login.post');
    Route::get('admin/logout', 'Backend\Auth\LoginController@logout')->name('admin.logout');

// Registration Routes...
    Route::get('admin/register', 'Backend\Auth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('admin/register', 'Backend\Auth\RegisterController@register')->name('admin.register.post');

// Password Reset Routes...
    Route::get('admin/password/reset',
        'Backend\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('admin/password/email',
        'Backend\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('admin/password/reset/{token}',
        'Backend\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('admin/password/reset', 'Backend\Auth\ResetPasswordController@reset')->name('admin.password.update');

