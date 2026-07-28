
<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group([ 'middleware'=>'admin', 'prefix'=>'admin'], function(){

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin#dashboard');

    Route::group(['prefix'=>'category'], function(){

        Route::get('list', [CategoryController::class, 'categoryList'])->name('category#list');

        Route::post('create', [CategoryController::class, 'createCategory'])->name('category#create');

        Route::delete('delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category#delete');

        Route::get('edit/{id}', [CategoryController::class, 'editCategory'])->name('category#edit');

        Route::post('update/{id}', [CategoryController::class, 'updateCategory'])->name('category#update');
        
        // Route::get('update/{id}', [CategoryController::class, 'updateCategory'])->name('category#update');

    });

    Route::group(['prefix'=>'product'], function(){

      Route::get('list/{action?}', [ProductController::class, 'productList'])->name('product#list');

      Route::post('create', [ProductController::class, 'createProduct'])->name('product#create');

      Route::get('add', [ProductController::class, 'addProduct'])->name('product#add');

      Route::get('detail/{id}/{slug}', [ProductController::class, 'showDetailProduct'])->name('product#detail');

      Route::delete('delete/{id}', [ProductController::class, 'deleteProduct'])->name('product#delete');

    //   Route::get('edit/{id}', [ProductController::class, 'editProduct'])->name('product#edit');
      Route::get('edit/{id}/{slug}', [ProductController::class, 'editProduct'])->name('product#edit');

      Route::post('update/{id}/{slug}', [ProductController::class, 'updateProduct'])->name('product#update');

        
      
    });

    

    

    Route::group(['prefix'=>'profile'], function(){

            Route::get('change/password', [ProfileController::class, 'passwordChange'])->name('profile#changePassword');
            Route::post('change/password', [ProfileController::class, 'changePassword'])->name('change#profilePassword');
            Route::get('edit',[ProfileController::class, 'editProfile'])->name('edit#profile');
            Route::post('update', [ProfileController::class, 'updateProfile'])->name('update#profile');
            
            

            });

 Route::group(['middleware'=>'superadmin'], function(){


      Route::group(['prefix'=>'payment'], function(){

        Route::get('create', [PaymentController::class, 'paymentCreate'])->name('payment#create');
           Route::post('create', [PaymentController::class, 'createPayment'])->name('payment#submit');
           Route::get('list', [PaymentController::class, 'paymentList'])->name('payment#list');
           Route::get('edit/{id}', [PaymentController::class, 'editPayment'])->name('payment#edit');
           Route::post('update/{id}', [PaymentController::class, 'updatePayment'])->name('payment#update');
            Route::delete('delete/{id}', [PaymentController::class, 'deletePayment'])->name('payment#delete');



      });
         Route::group(['prefix'=>'account'], function(){
              Route::get('add', [AdminController::class, 'addNewAdmin'])->name('add#newAdmin');
              Route::post('create', [AdminController::class, 'createNewAdmin'])->name('create#newAdmin');
              Route::get('userList', [AdminController::class, 'userList'])->name('user#list');
              Route::get('adminList', [AdminController::class, 'adminList'])->name('account#adminList');
              Route::delete('admin/delete/{id}',[AdminController::class, 'deleteAdminAccount'])->name('account#delete');
              Route::delete('user/delete/{id}', [AdminController::class, 'deleteUserAccount'])->name('userAccount#delete');

            });



      
          
    });

     Route::group([ 'prefix'=>'order'], function(){

    Route::get('orderList', [OrderController::class, 'orderList'])->name('order#List');

    Route::get('orderDetail/{orderCode}', [OrderController::class, 'orderDetail'])->name('orderDetail');

    Route::get('orderReject', [OrderController::class, 'orderReject'])->name('admin#orderReject');
    Route::get('orderStatusChange', [OrderController::class, 'orderStatusChange'])->name('orderStatusChange');
    Route::get('orderConfirm', [OrderController::class, 'orderConfirm'])->name('orderConfirm');


    });

    
    Route::group(['prefix'=> 'sale'], function(){

     Route::get('saleInfo', [OrderController::class, 'saleInfo'])->name('saleInfo');
    });

   
    Route::group(['prefix'=> 'message'], function(){

     Route::get('viewMessage', [AdminController::class, 'viewUserMessage'])->name('viewUserMessage');
      Route::delete('delete/{id}', [AdminController::class, 'deleteUserMessage'])->name('message#delete');


    });


});

  // Route::group(['middleware'=>'superadmin'], function(){


  //     Route::group(['prefix'=>'payment'], function(){

  //       Route::get('create', [PaymentController::class, 'paymentCreate'])->name('payment#create');
  //          Route::post('create', [PaymentController::class, 'createPayment'])->name('payment#submit');
  //          Route::get('list', [PaymentController::class, 'paymentList'])->name('payment#list');
  //          Route::get('edit/{id}', [PaymentController::class, 'editPayment'])->name('payment#edit');
  //          Route::post('update/{id}', [PaymentController::class, 'updatePayment'])->name('payment#update');
  //           Route::delete('delete/{id}', [PaymentController::class, 'deletePayment'])->name('payment#delete');



  //     });
  //        Route::group(['prefix'=>'account'], function(){
  //             Route::get('add', [AdminController::class, 'addNewAdmin'])->name('add#newAdmin');
  //             Route::post('create', [AdminController::class, 'createNewAdmin'])->name('create#newAdmin');
  //             Route::get('userList', [AdminController::class, 'userList'])->name('user#list');
  //             Route::get('adminList', [AdminController::class, 'adminList'])->name('account#adminList');
  //             Route::delete('admin/delete/{id}',[AdminController::class, 'deleteAdminAccount'])->name('account#delete');
  //             Route::delete('user/delete/{id}', [AdminController::class, 'deleteUserAccount'])->name('userAccount#delete');

  //           });



        

          
  //   });
    
        

  