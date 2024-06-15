<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Illuminate\Http\Request;

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PlaceController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/
Route::get("/logout",[LoginController::class,'logout'])->name("logout");

Route::middleware(['admin_login'])->group(function () {
    Route::get("/login",[LoginController::class,'index'])->name("login");
    Route::post("/login",[LoginController::class,'authenticate'])->name("login.submit");
});


Route::middleware(['auth:admin'])->group(function () {
    Route::get('/', [DashboardController::class,'index'])->name("admin");

    Route::get("/users",[UserController::class,"index"])->name("admin.users");
    Route::get("/users/create",[UserController::class,"create"])->name("admin.users.create");
    Route::post("/users/store",[UserController::class,"store"])->name("admin.users.store");
    Route::get("/users/edit/{id}",[UserController::class,"edit"])->name("admin.users.edit");
    Route::post("/users/update",[UserController::class,"update"])->name("admin.users.update");
    Route::get("/users/destroy/{id}",[UserController::class,"destroy"])->name("admin.users.destroy");


    Route::get("/vendors",[VendorController::class,"index"])->name("admin.vendors");
    Route::get("/vendors/create",[VendorController::class,"create"])->name("admin.vendors.create");
    Route::post("/vendors/store",[VendorController::class,"store"])->name("admin.vendors.store");
    Route::get("/vendors/edit/{id}",[VendorController::class,"edit"])->name("admin.vendors.edit");
    Route::post("/vendors/update",[VendorController::class,"update"])->name("admin.vendors.update");
    Route::get("/vendors/destroy/{id}",[VendorController::class,"destroy"])->name("admin.vendors.destroy");
    
    Route::get("/vendor/{id}/services",[VendorController::class,"vendor_services"])->name("admin.vendors.services");
    Route::post("/vendor/{id}/services/attach",[VendorController::class,"vendor_services_attach"])->name("admin.vendor.service.attach");
    Route::get("/vendor/{vendor_id}/service/{service_id}/detach",[VendorController::class,"vendor_services_detach"])->name("admin.vendor.servic.detach");
    
    Route::get("/vendor/{id}/places",[VendorController::class,"vendor_places"])->name("admin.vendors.places");
    Route::post("/vendor/{id}/places/attach",[VendorController::class,"vendor_places_attach"])->name("admin.vendor.place.attach");
    Route::get("/vendor/{vendor_id}/place/{place_id}/detach",[VendorController::class,"vendor_places_detach"])->name("admin.vendor.place.detach");

    Route::get("/products",[ProductController::class,"index"])->name("admin.products");
    Route::get("/products/create",[ProductController::class,"create"])->name("admin.products.create");
    Route::post("/products/store",[ProductController::class,"store"])->name("admin.products.store");
    Route::get("/products/edit/{id}",[ProductController::class,"edit"])->name("admin.products.edit");
    Route::post("/products/update",[ProductController::class,"update"])->name("admin.products.update");
    Route::get("/products/destroy/{id}",[ProductController::class,"destroy"])->name("admin.products.destroy");

    Route::get("/services",[ServiceController::class,"index"])->name("admin.services");
    Route::get("/services/create",[ServiceController::class,"create"])->name("admin.services.create");
    Route::post("/services/store",[ServiceController::class,"store"])->name("admin.services.store");
    Route::get("/services/edit/{id}",[ServiceController::class,"edit"])->name("admin.services.edit");
    Route::post("/services/update",[ServiceController::class,"update"])->name("admin.services.update");
    Route::get("/services/destroy/{id}",[ServiceController::class,"destroy"])->name("admin.services.destroy");
    Route::get("/services/{id}/products",[ServiceController::class,"service_products"])->name("admin.services.products");
    Route::post("/services/{id}/products/attach",[ServiceController::class,"service_products_attach"])->name("admin.service.products.attach");
    Route::get("/services/{service_id}/products/{product_id}/detach",[ServiceController::class,"service_products_detach"])->name("admin.service.product.detach");
    
    
    Route::get("/places",[PlaceController::class,"index"])->name("admin.places");
    Route::get("/places/create",[PlaceController::class,"create"])->name("admin.places.create");
    Route::post("/places/store",[PlaceController::class,"store"])->name("admin.places.store");
    Route::get("/places/edit/{id}",[PlaceController::class,"edit"])->name("admin.places.edit");
    Route::post("/places/update",[PlaceController::class,"update"])->name("admin.places.update");
    Route::get("/places/destroy/{id}",[PlaceController::class,"destroy"])->name("admin.places.destroy");
});

