<?php
Route::post('/booked', 'BookingController@booked')->name('booked');
Route::get('/booking_after/{event}', 'BookingController@bookingAfter')->name('booking_after');
Route::get('/getDays', 'BookingController@getDays')->name('getDays');
Route::get('/getTimeSlots', 'BookingController@getTimeSlots')->name('getTimeSlots');
Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/booking', 'BookingController@index')->name('booking');
Route::get('/getBooked', 'BookingController@getBooked')->name('getBooked');
Auth::routes(['register' => false]);
