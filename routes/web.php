<?php

Route::get('/', function () {
    return redirect('/projects');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    // Projects
    Route::resource('projects', 'ProjectsController');
    Route::post('projects/{project}/invite', 'ProjectInvitationsController@store');
    // Tasks
    Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
    Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');
});

Auth::routes();
