<?php

use App\Models\listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;



//All listings
Route::get('/home',[ListingController::class, 'index']);


//Show create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');


//Store listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');


//Show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');


//Update listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');


//Delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//Manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

//Single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//show register create form

Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//create new user
Route::post('/users', [UserController::class, 'store']);

//log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');


//show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::get('/users/posts', [UserController::class, 'auth']);



