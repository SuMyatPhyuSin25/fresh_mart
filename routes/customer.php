<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\ProfileController;
   use App\Http\Controllers\ContactController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'customer','middleware'=>'customer'], function(){

 Route::get('home',[CustomerController::class, 'customerHome'] )->name('customerHome');
 Route::get('about',[CustomerController::class, 'viewAboutUs'] )->name('aboutUs');

 
   Route::group(['prefix'=>'profile'], function(){

        Route::get('edit', [ProfileController::class, 'editProfile'])->name('edit#CustomerProfile');
        Route::post('update', [ProfileController::class, 'updateProfile'])->name('profile#update');
        Route::get('change/password', [ProfileController::class, 'customerPasswordChange'])->name('change#CustomerPassword');
        Route::post('change/password', [ProfileController::class, 'updatePassword'])->name('update#CustomerPassword');
    });


    Route::get('/shop', [CustomerController::class, 'viewShopPage'])->name('shop#Page');

    Route::get('/product/detail/{id}', [ProductController::class, 'productDetail'])->name('product.Detail');

    Route::post('comment', [CommentController::class, 'postComment'])->name('post.Comment');

     Route::get('comment/delete/{id}', [ProductController::class, 'deleteComment'])->name('delete#Comment');

     Route::post('rating', [RatingController::class, 'postRating'])->name('post.Rating');

     
    Route::get('cart', [CartController::class, 'cart'])->name('customer.Cart');

    Route::post('addToCart', [CartController::class, 'addToCart'])->name('add.Cart');
    
     Route::get('cartDelete', [CartController::class, 'cartDelete'])->name('cartDelete');

     Route::get('tempStorage', [CartController::class, 'tempStorage'])->name('tempStorage');


        Route::get('order', [CartController::class, 'order']);
        Route::post('order', [CartController::class, 'order'])->name('customer#order');
        

      Route::get('paymentPage', [CartController::class, 'paymentPage'])->name('paymentPage');

   
    Route::get('orderList', [CartController::class, 'orderList'])->name('orderList');


 

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::post('/accept-cookie', [CustomerController::class, 'accept']) ->name('cookie.accept');

Route::get('/remove-cookie', [CustomerController::class, 'remove'])
    ->name('cookie.remove');


Route::post('/reject-cookie', [CustomerController::class, 'reject'])
    ->name('cookie.reject');


Route::get('/privacy-policy', [CustomerController::class, 'privacy'])->name('privacy');
Route::get('/terms-and-conditions', [CustomerController::class, 'terms'])->name('terms');
Route::get('/return-policy', [CustomerController::class, 'returns'])->name('returns');
Route::get('/faq', [CustomerController::class, 'faq'])->name('faq');

});