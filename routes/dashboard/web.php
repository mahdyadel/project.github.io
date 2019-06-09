<?php

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/index', 'DashboardController@index')->name('index');

            //category routes
            Route::resource('categories', 'CategoryController')->except(['show']);
            
             //tasks routes
             Route::resource('tasks', 'TaskController')->except(['show']);

            //product routes
            Route::resource('products', 'ProductController');

            //client routes
            Route::resource('clients', 'ClientController')->except(['show']);

            //user routes
            Route::resource('users', 'UserController')->except(['show']);

            Route::get('export_excel', 'ExportExcelController@index');

            Route::get('export_excel/excel', 'ExportExcelController@excel')->name('export_excel.excel');




        });//end of dashboard routes
    });


