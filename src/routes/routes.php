<?php

Route::get('/redirect', 'FluentAuthController@redirect')->middleware('web');
Route::get('/callback', 'FluentAuthController@callback')->middleware('web');
