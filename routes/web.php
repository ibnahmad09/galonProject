<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StockMutationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\ReferralSettingController;

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
        // Jika belum login, tampilkan halaman dashboard customer (mirip dashboard.blade.php)
        $products = \App\Models\Product::all();
        $news = \App\Models\News::orderBy('published_at', 'desc')->get();
        return view('customer.dashboard', compact('products', 'news'));
    }
});

// Authentication Routes
Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/{id}', [AdminController::class, 'orderDetail'])->name('admin.order.detail');
    Route::get('/deliveries', [AdminController::class, 'deliveries'])->name('admin.deliveries');
    Route::get('/deliveries/quick-update', [AdminController::class, 'quickUpdateDeliveries'])->name('admin.deliveries.quick-update');
    Route::get('/deliveries/available', [AdminController::class, 'availableDeliveries'])->name('admin.deliveries.available');
    Route::get('/deliveries/history', [AdminController::class, 'deliveryHistory'])->name('admin.deliveries.history');
    Route::get('/deliveries/{id}', [AdminController::class, 'deliveryDetail'])->name('admin.delivery.detail');
    Route::post('/deliveries/{id}/status', [AdminController::class, 'updateDeliveryStatus'])->name('admin.delivery.updateStatus');
    Route::post('/deliveries/{id}/accept', [AdminController::class, 'acceptDelivery'])->name('admin.delivery.accept');
    Route::post('/deliveries/{id}/quick-update', [AdminController::class, 'quickUpdateStatus'])->name('admin.delivery.quick-update');

    // Test route untuk debugging
    // Route::get('/test-quick-update', [AdminController::class, 'testQuickUpdate'])->name('test.quick-update');
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

    // Referral Settings
    Route::get('/referral-settings', [ReferralSettingController::class, 'index'])->name('admin.referral-settings.index');
    Route::put('/referral-settings', [ReferralSettingController::class, 'update'])->name('admin.referral-settings.update');
});

// Laporan Admin
Route::prefix('admin/reports')->middleware('admin')->name('admin.reports.')->group(function () {
    Route::get('/', [\App\Http\Controllers\ReportController::class, 'index'])->name('index');
    Route::get('/sales', [\App\Http\Controllers\ReportController::class, 'sales'])->name('sales');
    Route::get('/income', [\App\Http\Controllers\ReportController::class, 'income'])->name('income');
    Route::get('/deliveries', [\App\Http\Controllers\ReportController::class, 'deliveries'])->name('deliveries');
    Route::get('/export-pdf', [\App\Http\Controllers\ReportController::class, 'exportPdf'])->name('exportPdf');
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
    Route::get('/tracking/{trackingNumber}', [CustomerController::class, 'tracking'])->name('customer.tracking');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::post('/profile', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
    Route::post('/customer/profile/password', [CustomerController::class, 'updatePassword'])->name('customer.profile.password');
    Route::get('/about', [CustomerController::class, 'about'])->name('customer.about');
    Route::get('/news/{id}', [CustomerController::class, 'showNews'])->name('customer.news.show');

    // Referral Routes
    Route::get('/referral', [ReferralController::class, 'index'])->name('customer.referral.index');
    Route::post('/referral/validate', [ReferralController::class, 'validateCode'])->name('customer.referral.validate');
    Route::get('/referral/history', [ReferralController::class, 'getReferralHistory'])->name('customer.referral.history');
    Route::get('/referral/discounts', [ReferralController::class, 'showDiscounts'])->name('customer.referral.discounts');
    Route::get('/referral/available-discounts', [ReferralController::class, 'getAvailableDiscounts'])->name('customer.referral.available-discounts');
    Route::post('/referral/use-discount', [ReferralController::class, 'useDiscount'])->name('customer.referral.use-discount');
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

// Route untuk halaman about yang dapat diakses guest
Route::get('/about', function () {
    $news = \App\Models\News::orderByDesc('published_at')->get();
    return view('customer.about', compact('news'));
})->name('about');
