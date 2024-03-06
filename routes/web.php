<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\pdf_controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\routeController;
use App\Http\Controllers\updateController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [routeController::class, 'dashboard'])->name('dashboard');
    Route::get('/Register-Supplier', [routeController::class, 'Register_Supplier_route'])->name('Register-Supplier');
    Route::get('/Register-Item', [routeController::class, 'Register_Item_route'])->name('Register-Item');
    Route::get('/Archived', [routeController::class, 'Register_Archived_route'])->name('Archived');
    Route::get('/Ingredients-Volume', [routeController::class, 'Ingredients_Volume_route'])->name('Ingredients-Volume');
    Route::get('/POS', [routeController::class, 'POS_route'])->name('POS');
    Route::get('/brand-categories', [routeController::class, 'brand_categories'])->name('brand-categories');
    Route::get('/unit-categories', [routeController::class, 'unit_categories'])->name('unit-categories');
    Route::get('/supplier-categories', [routeController::class, 'supplier_categories'])->name('supplier-categories');
    Route::get('/toppins-add', [routeController::class, 'toppins_add'])->name('toppins-add');
    Route::get('/Ingredient-categories', [routeController::class, 'Ingredient_categories'])->name('Ingredient-categories');
    Route::get('/Sales_Report', [routeController::class, 'Sales_Report'])->name('Sales_Report');
    Route::get('/Account', [routeController::class, 'Account'])->name('Account');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //print
    Route::get('/sales_pdf', [pdf_controller::class, 'print_sales'])->name('sales_pdf');
    // Route::get('/post_pdf', [routeController::class, 'post_pdf'])->name('post_pdf');
    // POST
    Route::post('/register-sell/{OR}', [registerController::class, 'registerSell'])->name('register.sell');
    Route::post('/Insert-Supply', [registerController::class, 'register_supplier'])->name('Insert-Supply');
    Route::post('/Insert-Product', [registerController::class, 'register_product'])->name('Insert-Product');
    Route::post('/Insert-unit', [registerController::class, 'register_unit'])->name('Insert-unit');
    Route::post('/Insert-brand', [registerController::class, 'register_brand'])->name('Insert-brand');
    Route::post('/Insert-ingredient', [registerController::class, 'register_ingredient'])->name('Insert-ingredient');
    Route::post('/Insert-toppings', [registerController::class, 'register_toppings'])->name('Insert-toppings');
    Route::post('/Insert-supcategories', [registerController::class, 'register_supcategories'])->name('Insert-supcategories');
    Route::post('/Insert-Order', [registerController::class, 'registerOrder'])->name('Insert-Order');
    Route::post('/Insert-User', [registerController::class, 'registerUser'])->name('Insert-User');
    Route::post('/cancelOrder/{OR}', [updateController::class, 'cancelOrder'])->name('cancelOrder.order');
    Route::post('/UpdateCategories', [updateController::class, 'UpdateCategories'])->name('Update-Categories');

    //Ajax
    Route::get('/find-recipe/{category}', [AjaxController::class,  'findRecipe'])->name('find-recipe');
    //uddate
    Route::post('/updateUserType', [updateController::class, 'updateUserType'])->name('updateUserType');
    Route::post('/updateItem', [updateController::class, 'updateItem'])->name('updateItem');

    Route::post('/Update-Supply', [updateController::class, 'updateSupplier'])->name('Update-Supply');
    Route::post('/Update-Volume', [updateController::class, 'updateVolume'])->name('Update-Volume');
});

// Route::middleware('auth')->group(function () {
// });

require __DIR__ . '/auth.php';
