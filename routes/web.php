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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();


Route::group(["middleware" => "auth"], function() {
    Route::get('/home', 'HomeController@index')->name('home');


    Route::get('/settings', 'SettingsController@index')->name('settings.index');


    Route::get('courses/get', 'CourseController@getCourses');
    Route::resource('courses', 'CourseController');

    Route::get('templates/get', 'TemplateController@getTemplates');
    Route::resource('templates', 'TemplateController');

    Route::get('tasks/get', 'TaskController@getTasks');
    Route::resource('tasks', 'TaskController');
});
