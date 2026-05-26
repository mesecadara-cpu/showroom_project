<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowroomController;
use App\Http\Controllers\Admin\ProductController as AdminProduct;
use App\Http\Controllers\OrderController;

// Главная
Route::get('/', [ShowroomController::class, 'index'])->name('home');
// КАТАЛОГ — теперь он связан с контроллером, ошибка уйдет
Route::get('/catalog', [ShowroomController::class, 'catalog'])->name('catalog');
// О нас и Доставка
Route::get('/about', [ShowroomController::class, 'about'])->name('about');
Route::get('/delivery', [ShowroomController::class, 'delivery'])->name('delivery');
// КОРЗИНА
Route::get('/cart', [ShowroomController::class, 'cart'])->name('cart');
Route::post('/add-to-cart/{id}', [ShowroomController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [App\Http\Controllers\ShowroomController::class, 'removeFromCart'])->name('cart.remove');
Route::patch('/cart/update/{id}', [App\Http\Controllers\ShowroomController::class, 'updateCart'])->name('cart.update');
Route::get('/catalog/{id}', [App\Http\Controllers\ShowroomController::class, 'show'])->name('product.show');
// АДМИНКА — убрали 'auth', оставили только 'basic-auth'
Route::prefix('admin')
    ->middleware(['basic-auth'])
    ->group(function () {
        Route::get('/', [AdminProduct::class, 'index'])->name('admin.index');
        Route::get('/products/create', [AdminProduct::class, 'create'])->name('admin.products.create');
        Route::post('/products/store', [AdminProduct::class, 'store'])->name('admin.products.store');
        Route::get('/products/{product}/edit', [AdminProduct::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{product}', [AdminProduct::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{product}', [AdminProduct::class, 'destroy'])->name('admin.products.delete');
    });
// ЗАКАЗЫ (выносим сюда, чтобы адрес был простым)
Route::get('/admin-orders', [OrderController::class, 'adminIndex'])->name('admin.orders');
Route::delete('/admin-orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
