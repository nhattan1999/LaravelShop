<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
//frontend
Route::get('/',[HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);
Route::post('/find-product', [HomeController::class, 'find_product']);

//CategoryHome
Route::get('/category/{category_id}', [CategoryProduct::class, 'show_category_home']);
Route::get('/product-detail/{product_id}', [ProductController::class, 'show_product_detail']);

//backend
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);

//CategoryProduct
Route::get('/add-category', [CategoryProduct::class, 'add_category']);
Route::get('/edit-category/{category_id}', [CategoryProduct::class, 'edit_category']);
Route::get('/delete-category/{category_id}', [CategoryProduct::class, 'delete_category']);
Route::get('/view-category', [CategoryProduct::class, 'view_category']);
Route::post('/save-category-product', [CategoryProduct::class, 'save_category']);
Route::post('/update-category-product/{category_id}', [CategoryProduct::class, 'save_update_category']);

//Product
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
Route::get('/view-product', [ProductController::class, 'view_product']);
Route::post('/save-product', [ProductController::class, 'save_product']);
Route::post('/search-product', [ProductController::class, 'search_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'save_update_product']);
Route::post('/export-csv', [ProductController::class, 'export_csv']);
Route::post('/import-csv', [ProductController::class, 'import_csv']);

//Cart
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::get('/delete-cart/{row_id}', [CartController::class, 'delete_cart']);
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);

//check_out
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::get('/order', [CheckoutController::class, 'order']);

//Order
Route::get('/add-order', [OrderController::class, 'add_order']);
Route::get('/edit-order/{order_id}', [OrderController::class, 'edit_order']);
Route::get('/delete-order/{order_id}', [OrderController::class, 'delete_order']);
Route::get('/view-order', [OrderController::class, 'view_order']);

//Send mail
Route::get('/send-email/{order_id}', [CheckoutController::class, 'send_email']);
