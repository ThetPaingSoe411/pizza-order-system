<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\User\UserController;







//login/Register,........
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});


Route::middleware(['auth'])->group(function () {

//dashboard
Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    //------------------Admin-------------------------------
Route::group(['middleware'=>'admin_auth'],function(){
 //-----------category---------------------
 Route::group(['prefix'=>'category'],function(){
    Route::get('list',[CategoryController::class,'list'])->name('category#list');
    Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
    Route::post('create',[CategoryController::class,'create'])->name('category#create');
    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
    Route::post('update',[CategoryController::class,'update'])->name('category#update');
    });
});
//--------admin Account----------------------------
Route::prefix('admin')->group(function(){
//password
    Route::get('password/change',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');
//account profile
Route::get('details',[AdminController::class,'details'])->name('admin#details');
Route::get('profile',[AdminController::class,'profile'])->name('admin#profile');
Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');


//adminlist
Route::get('list',[AdminController::class,'adminlist'])->name('admin#list');
Route::get('delete/{id}',[AdminController::class,'admindelete'])->name('admin#delete');
Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
Route::post('change/{id}',[AdminController::class,'change'])->name('admin#change');
});
//--products---
Route::prefix('products')->group(function(){
Route::get('list',[ProductController::class,'productlist'])->name('admin#productlist');
Route::get('create',[ProductController::class,'productCreate'])->name('admin#productCreate');
Route::post('create',[ProductController::class,'Create'])->name('product#Create');
Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
Route::get('edit{id}',[ProductController::class,'edit'])->name('product#edit');
Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
Route::post('update',[ProductController::class,'update'])->name('product#update');
});
//order
Route::prefix('order')->group(function(){
Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
Route::get('change/status',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('admin#listInfo');
});
//user list
Route::prefix('user')->group(function(){
    Route::get('list',[AdminUserController::class,'userList'])->name('admin#userList');
    Route::get('change/role',[AdminUserController::class,'changeRole'])->name('admin#userChangeRole');
    Route::get('adminlist',[AdminUserController::class,'adminList'])->name('admin#adminList');
    Route::get('admin/change/role',[AdminUserController::class,'adminChangeRole'])->name('admin#adminChangeRole');
    Route::get('adminDelete/{id}',[AdminUserController::class,'adminDelete'])->name('admin#adminDelete');
    Route::get('userDelete/{id}',[AdminUserController::class,'userDelete'])->name('admin#userDelete');
});
Route::prefix('contact')->group(function(){
    Route::get('page',[ContactController::class,'contactPage'])->name('admin#contactPage');
    Route::get('delete/{id}',[ContactController::class,'delete'])->name('admin#contactDelete');
});


//------------------user--------------------------------
//------home------
Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
    Route::get('homePage',[UserController::class,'home'])->name('user#home');
    Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
    Route::get('history',[UserController::class,'history'])->name('user#history');


    Route::prefix('pizza')->group(function(){
        Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#pizzaDetails');
    });
    Route::prefix('cart')->group(function(){
        Route::get('list',[UserController::class,'cartList'])->name('user#cartList');

    });

//----------password change
Route::prefix('password')->group(function(){
    Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
    Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
    });
    //---------User Account
    Route::prefix('account')->group(function(){
    Route::get('change',[UserController::class,'accountChagePage'])->name('user#acccountChange');
    Route::post('changeAccount/{id}',[UserController::class,'accountChange'])->name('user#acount');
    });
  //---------User contact
  Route::prefix('contact')->group(function(){
    Route::get('page',[UserController::class,'UserContactPage'])->name('user#contactPage');
    Route::post('data',[UserController::class,'UserContactData'])->name('user#contactData');
    });

    Route::prefix('ajax')->group(function(){
        Route::get('pizzalist',[AjaxController::class,'pizzalist'])->name('ajax#pizzalist');
        Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
        Route::get('order',[AjaxController::class,'order'])->name('ajax#Order');
        Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
        Route::get('clear/current/product',[AjaxController::class,'clearCurrentProduct'])->name('ajax#currentProduct');
        Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
    });
});


 });



