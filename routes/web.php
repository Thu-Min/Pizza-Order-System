<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PizzaController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Middleware\UserCheckkMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin#profile');
            } else if (Auth::user()->role == 'user') {
                return redirect()->route('user#index');
            }
        }
    })->name('dashboard');
});

Route::middleware([AdminCheckMiddleware::class])->prefix('admin')->namespace('Admin')->group(function () {

    Route::get('profile', [AdminController::class, 'profile'])->name('admin#profile');
    Route::post('update/{id}', [AdminController::class, 'updateProfile'])->name('admin#updateProfile');
    Route::get('changePasswordPage/{id}', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('changePassword/{id}', [AdminController::class, 'changePassword'])->name('admin#changePassword');

    Route::get('userList', [AdminUserController::class, 'userList'])->name('admin#userList');
    Route::get('adminList', [AdminUserController::class, 'adminList'])->name('admin#adminList');
    Route::get('userList/search', [AdminUserController::class, 'userSearch'])->name('admin#userSearch');
    Route::get('userList/delete/{id}', [AdminUserController::class, 'userDelete'])->name('admin#userDelete');
    Route::get('adminList/search', [AdminUserController::class, 'adminSearch'])->name('admin#adminSearch');

    Route::get('category', [CategoryController::class, 'category'])->name('admin#category');
    Route::get('addCategoryPage', [CategoryController::class, 'addCategoryPage'])->name('admin#addCategoryPage');
    Route::post('addCategory', [CategoryController::class, 'addCategory'])->name('admin#addCategory');
    Route::get('deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('admin#deleteCategory');
    Route::get('updateCategory/{id}', [CategoryController::class, 'updateCategoryPage'])->name('admin#updateCategoryPage');
    Route::post('editCategory', [CategoryController::class, 'editCategory'])->name('admin#editCategory');
    Route::get('categroy/search', [CategoryController::class, 'searchCategory'])->name('admin#searchCategory');
    Route::get('categoryItem/{id}', [PizzaController::class, 'categoryItem'])->name('admin#categoryItem');
    Route::get('category/download', [CategoryController::class, 'categoryDownload'])->name('admin#categoryDownload');

    Route::get('pizza', [PizzaController::class, 'pizza'])->name('admin#pizza');
    Route::get('createPizza', [PizzaController::class, 'createPizza'])->name('admin#createPizza');
    Route::post('insertPizza', [PizzaController::class, 'insertPizza'])->name('admin#insertPizza');
    Route::get('deletePizza/{id}', [PizzaController::class, 'deletePizza'])->name('admin#deletePizza');
    Route::get('infoPizza/{id}', [PizzaController::class, 'infoPizza'])->name('admin#infoPizza');
    Route::get('updatePizzaPage/{id}', [PizzaController::class, 'updatePizzaPage'])->name('admin#updatePizzaPage');
    Route::post('updatePizza/{id}', [PizzaController::class, 'updatePizza'])->name('admin#updatePizza');
    Route::post('pizza', [PizzaController::class, 'searchPizza'])->name('admin#searchPizza');
    Route::get('pizza/download', [PizzaController::class, 'pizzaDownload'])->name('admin#pizzaDownload');

    Route::get('contactList', [ContactController::class, 'contactList'])->name('admin#contactList');
    Route::get('contact/Search', [ContactController::class, 'contactSearch'])->name('admin#contactSearch');

    Route::get('order/list', [OrderController::class, 'orderList'])->name('admin#orderList');
    Route::get('order/search', [OrderController::class, 'orderSearch'])->name('admin#orderSearch');
    Route::get('order/download', [OrderController::class, 'orderDownload'])->name('admin#orderDownload');
});

Route::prefix('user')->middleware([UserCheckkMiddleware::class])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user#index');

    Route::post('contact/create', [ContactController::class, 'createContact'])->name('user#createContact');

    Route::get('pizza/details/{id}', [UserController::class, 'pizzaDetails'])->name('user#pizzaDetails');
    Route::get('category/search/{id}', [UserController::class, 'categorySearch'])->name('user#categorySearch');
    Route::get('search/item', [UserController::class, 'searchItem'])->name('user#searchItem');
    Route::get('search/pizzaItem', [UserController::class, 'searchPizzaItem'])->name('user#searchPizzaItem');
    Route::get('order', [UserController::class, 'order'])->name('user#order');
    Route::post('order', [UserController::class, 'placeOrder'])->name('user#placeOrder');

});
