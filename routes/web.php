<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    if (Auth::check()) {
        // Jika sudah login, arahkan ke dashboard customer
        return redirect()->route('customer.dashboard');
    } else {
        // Jika belum login, tampilkan halaman produk customer
        $category = null;
        $products = \App\Models\Product::all();
        return view('customer.products', compact('products', 'category'));
    }
});

Auth::routes();

// Admin Routes
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/{id}', [AdminController::class, 'orderDetail'])->name('admin.order.detail');
    Route::post('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');
    Route::post('/orders/{orderId}/assign-courier', [AdminController::class, 'assignCourier'])->name('admin.assign.courier');
    Route::get('/deliveries', [AdminController::class, 'deliveries'])->name('admin.deliveries');
    Route::get('/deliveries/{id}', [AdminController::class, 'deliveryDetail'])->name('admin.delivery.detail');
    Route::get('/promotions', [AdminController::class, 'promotions'])->name('admin.promotions');
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');
    Route::get('/news', [AdminController::class, 'newsIndex'])->name('admin.news.index');
    Route::get('/news/create', [AdminController::class, 'newsCreate'])->name('admin.news.create');
    Route::post('/news', [AdminController::class, 'newsStore'])->name('admin.news.store');
    Route::get('/news/{id}/edit', [AdminController::class, 'newsEdit'])->name('admin.news.edit');
    Route::put('/news/{id}', [AdminController::class, 'newsUpdate'])->name('admin.news.update');
    Route::delete('/news/{id}', [AdminController::class, 'newsDestroy'])->name('admin.news.destroy');
});

// Customer Routes
Route::prefix('customer')->middleware('customer')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/products', [CustomerController::class, 'products'])->name('customer.products');
    Route::get('/product/{id}', [CustomerController::class, 'productDetail'])->name('customer.product.detail');
    Route::get('/cart', [CartController::class, 'cart'])->name('customer.cart');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/checkout', [CustomerController::class, 'checkout'])->name('customer.checkout');
    Route::get('/order-history', [CustomerController::class, 'orderHistory'])->name('customer.order.history');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::post('/profile', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
    Route::post('/customer/profile/password', [CustomerController::class, 'updatePassword'])->name('customer.profile.password');
    Route::get('/about', [CustomerController::class, 'about'])->name('customer.about');
    Route::get('/news/{id}', [CustomerController::class, 'showNews'])->name('customer.news.show');
});

// Courier Routes
Route::prefix('courier')->middleware('courier')->group(function () {
    Route::get('/dashboard', [CourierController::class, 'dashboard'])->name('courier.dashboard');
    Route::get('/deliveries', [CourierController::class, 'deliveries'])->name('courier.deliveries');
    Route::get('/delivery/{id}', [CourierController::class, 'deliveryDetail'])->name('courier.delivery-detail');
    Route::post('/delivery/{id}/status', [CourierController::class, 'updateDeliveryStatus'])->name('courier.update-delivery-status');
    Route::get('/available-deliveries', [CourierController::class, 'availableDeliveries'])->name('courier.available-deliveries');
    Route::post('/delivery/{id}/accept', [CourierController::class, 'acceptDelivery'])->name('courier.accept-delivery');
    Route::get('/delivery-history', [CourierController::class, 'deliveryHistory'])->name('courier.delivery-history');
    Route::post('/notifications/{id}/mark-read', [CourierController::class, 'markNotificationAsRead'])->name('courier.notifications.mark-read');
});

// Promotions
Route::resource('promotions', PromotionController::class)->middleware('admin');

// Notifications
Route::post('/notifications/send', [NotificationController::class, 'send'])->name('notifications.send');
Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

// Stock Mutations
Route::get('/admin/stock', [StockMutationController::class, 'index'])->name('admin.stock');
Route::post('/admin/stock/restock', [StockMutationController::class, 'restock'])->name('admin.stock.restock');

// Order Place
Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
