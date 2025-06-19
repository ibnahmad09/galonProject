<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StockMutationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $products = \App\Models\Product::take(3)->get();
    return view('welcome', compact('products'));
});

Auth::routes();

// Admin Routes
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/promotions', [AdminController::class, 'promotions'])->name('admin.promotions');
    Route::post('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');
});

// Customer Routes
Route::prefix('customer')->middleware('customer')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/product/{id}', [CustomerController::class, 'productDetail'])->name('customer.product.detail');
    Route::get('/cart', [CartController::class, 'cart'])->name('customer.cart');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout', [CustomerController::class, 'checkout'])->name('customer.checkout');
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/orders', [CustomerController::class, 'orderHistory'])->name('customer.order.history');
});

// Courier Routes
Route::prefix('courier')->middleware('courier')->group(function () {
    Route::get('/dashboard', [CourierController::class, 'dashboard'])->name('courier.dashboard');
    Route::post('/delivery/{id}/status', [CourierController::class, 'updateDeliveryStatus'])->name('courier.delivery.updateStatus');
});

// Promotions
Route::resource('promotions', PromotionController::class)->middleware('admin');

// Notifications
Route::post('/notifications/send', [NotificationController::class, 'send'])->name('notifications.send');
Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

// Stock Mutations
Route::get('/admin/stock', [StockMutationController::class, 'index'])->name('admin.stock');
Route::post('/admin/stock/restock', [StockMutationController::class, 'restock'])->name('admin.stock.restock');

// Assign Courier
Route::post('/admin/orders/{orderId}/assign-courier', [AdminController::class, 'assignCourier'])->name('admin.assign.courier');