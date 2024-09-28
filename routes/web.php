<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Frontend\CarController as FrontendCarController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\RentalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminAPI_Auth;
use App\Http\Middleware\CheckAdminRole_AuthMiddleware;
use App\Http\Middleware\CheckCustomerRole_AuthMiddleware;
use App\Http\Middleware\CheckUserRole;
use App\Http\Middleware\CustomerAPI_Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


//Page Routes

Route::get('/', action: [HomeController::class, 'HomePage'])->middleware([CheckUserRole::class]);

Route::get('/login', action: [UserController::class, 'LoginPage'])->middleware([CheckUserRole::class]);

Route::get('/about', action: [PageController::class, 'AboutPage'])->middleware([CheckUserRole::class]);
Route::get('/service', action: [PageController::class, 'ServicePage'])->middleware([CheckUserRole::class]);
Route::get(uri: '/contact', action: [PageController::class, 'contactPage'])->middleware([CheckUserRole::class]);


Route::get('/admin/dashboard', action: [HomeController::class, 'AdminDashPage'])->middleware([CheckAdminRole_AuthMiddleware::class]);
Route::get('/admin/carPage', action: [HomeController::class, 'AdminCarPage'])->middleware([CheckAdminRole_AuthMiddleware::class]);
Route::get('/admin/customerPage', action: [HomeController::class, 'AdminCustomerPage'])->middleware([CheckAdminRole_AuthMiddleware::class]);
Route::get('/admin/rentalPage', action: [HomeController::class, 'AdminRentalPage'])->middleware([CheckAdminRole_AuthMiddleware::class]);
Route::get('/admin/rentalPage/create', action: [HomeController::class, 'AdminRentalCreatePage'])->middleware([CheckAdminRole_AuthMiddleware::class]);

Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::get('/logout', [UserController::class, 'UserLogOut']);

Route::get('/my-booking', [PageController::class, 'BookingPage'])->middleware([CheckCustomerRole_AuthMiddleware::class]);

// Admin Car API
Route::post('/admin/create-car', [CarController::class, 'CarCreate'])->middleware([CheckAdminRole_AuthMiddleware::class]);
Route::post('/admin/update-car', [CarController::class, 'CarUpdate'])->middleware([CheckAdminRole_AuthMiddleware::class]);
Route::post('/admin/delete-car', [CarController::class, 'CarDelete'])->middleware([CheckAdminRole_AuthMiddleware::class]);
Route::get('/admin/list-car', [CarController::class, 'CarList'])->middleware([CheckAdminRole_AuthMiddleware::class]);
Route::post('/admin/car-by-id', [CarController::class, 'CarById'])->middleware([CheckAdminRole_AuthMiddleware::class]);
Route::post('/admin/update-car-availability', [CarController::class, 'CarStatusUpdate'])->middleware([CheckAdminRole_AuthMiddleware::class]);

Route::middleware([CheckAdminRole_AuthMiddleware::class])->group(function () {
    Route::post('/admin/create-customer', [CustomerController::class, 'CustomerCreate']);
    Route::post('/admin/update-customer', [CustomerController::class, 'CustomerUpdate']);
    Route::post('/admin/delete-customer', [CustomerController::class, 'CustomerDelete']);
    Route::get('/admin/list-customer', [CustomerController::class, 'CustomerList']);
    Route::post('/admin/customer-by-id', [CustomerController::class, 'CustomerById']);
});

// Admin API middleware for response unauthorized
Route::middleware([AdminAPI_Auth::class])->group(function () {
    Route::get('/admin/rental/list-available-car', [AdminRentalController::class, 'availableCarForRent']);
    Route::get('/admin/rental/list-rental', [AdminRentalController::class, 'RentalList']);
    Route::post('/admin/rental/update-rental', [AdminRentalController::class, 'RentalUpdate']);
    Route::post('/admin/rental/delete-rental', [AdminRentalController::class, 'RentalDelete']);
    Route::post('/admin/rental/create-rental', [AdminRentalController::class, 'RentalCreate']);
    Route::get('/admin/rental/rental-by-id', [AdminRentalController::class, 'RentalById']);
});



Route::get('/car', [FrontendCarController::class, 'CarPage'])->middleware([CheckUserRole::class]);
Route::get('/carFilterData', [FrontendCarController::class, 'CarFilterData']);

Route::post('/create-rental', [RentalController::class, 'RentalCreate'])->middleware([CustomerAPI_Auth::class]);
Route::post('/update-rental', [RentalController::class, 'RentalUpdate'])->middleware([CustomerAPI_Auth::class]);
Route::get('/list-rental', [RentalController::class, 'RentalList'])->middleware([CustomerAPI_Auth::class]);
Route::post('/rental-by-id', [RentalController::class, 'RentalById'])->middleware([CustomerAPI_Auth::class]);
