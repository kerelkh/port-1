<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleManagementController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryManagementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductManagementController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuoteManagementController;
use App\Http\Controllers\SettingController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [HomeController::class, 'sendMessage'])->name('send-message');

Route::middleware(['guest'])->group(function() {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth'])->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/content', [ContentController::class, 'index'])->name('content');
    Route::get('/content/getSupports', [ContentController::class, 'getSupports'])->name('get-supports');
    Route::delete('/content/support-delete/{id}', [ContentController::class, 'deleteSupport'])->name('delete-support');
    Route::post('/content/support', [ContentController::class, 'storeSupport'])->name('store-support');

    Route::get('/content/getReferrals', [ContentController::class, 'getReferrals'])->name('get-referrals');
    Route::delete('/content/referral-delete/{id}', [ContentController::class, 'deleteReferral'])->name('delete-referral');
    Route::post('/content/referral', [ContentController::class, 'storeReferral'])->name('store-referral');

    Route::post('/content/portrait/{id}', [ContentController::class, 'updatePortrait'])->name('update-portrait');
    Route::post('/content/square/{id}', [ContentController::class, 'updateSquare'])->name('update-square');

    Route::get('/admin/articles', [ArticleManagementController::class, 'index'])->name('admin-articles');
    Route::get('/admin/articles/getArticles', [ArticleManagementController::class, 'getArticles'])->name('get-articles');
    Route::get('/admin/articles/getArticle/{slug}', [ArticleManagementController::class, 'getArticle'])->name('get-article');
    Route::post('/admin/articles/updateArticle/{slug}', [ArticleManagementController::class, 'updateArticle'])->name('update-article');
    Route::get('/admin/articles/create', [ArticleManagementController::class, 'createArticle'])->name('create-article');
    Route::post('/admin/articles/store', [ArticleManagementController::class, 'storeArticle'])->name('store-article');
    Route::put('/admin/articles/updateStatusArticle/{slug}/{status}', [ArticleManagementController::class ,'updateStatusArticle'])->name('update-status-article');
    Route::put('/admin/articles/updateTypeArticle/{slug}/{type}', [ArticleManagementController::class ,'updateTypeArticle'])->name('update-type-article');
    Route::delete('/admin/articles/delete/{slug}', [ArticleManagementController::class, 'deleteArticle'])->name('delete-article');

    Route::get('/admin/quotes', [QuoteManagementController::class, 'index'])->name("admin-quotes");
    Route::get('/admin/quotes/getQuotes', [QuoteManagementController::class, 'getQuote'])->name('get-quotes');
    Route::post('/admin/quotes/storeQuote', [QuoteManagementController::class, 'storeQuote'])->name('store-quote');
    Route::delete('/admin/quotes/delete/{id}', [QuoteManagementController::class, 'deleteQuote'])->name('delete-quote');

    Route::get('/admin/gallery', [GalleryManagementController::class, 'index'])->name('admin-gallery');
    Route::get('/admin/galleries', [GalleryManagementController::class, 'getGalleries'])->name('get-galleries');
    Route::get("/admin/gallery/{id}", [GalleryManagementController::class, 'getGallery'])->name('get-gallery');
    Route::post('/admin/gallery/', [GalleryManagementController::class, 'storeGallery'])->name('store-gallery');
    Route::post('/admin/gallery/{id}', [GalleryManagementController::class, 'updateGallery'])->name('update-gallery');
    Route::delete('/admin/gallery/{id}', [GalleryManagementController::class, 'deleteGallery'])->name('delete-gallery');

    Route::get('/admin/products', [ProductManagementController::class, 'index'])->name('admin-products');
    Route::get('/admin/products/get-product/{slug}', [ProductManagementController::class, 'getProduct'])->name('get-product');
    Route::get('/admin/products/get-all', [ProductManagementController::class, 'getProducts'])->name('get-products');
    Route::get('/admin/products/create', [ProductManagementController::class, 'createProduct'])->name('create-product');
    Route::post('/admin/product/store-product', [ProductManagementController::class, 'storeProduct'])->name('store-product');
    Route::put('/admin/products/update-image/{slug}', [ProductManagementController::class, 'updateImageProduct'])->name('update-image-product');
    Route::post('/admin/products/update/{slug}', [ProductManagementController::class, 'updateProduct'])->name('update-product');
    Route::delete('/admin/products/delete/{slug}', [ProductManagementController::class, 'deleteProduct'])->name('delete-product');

    Route::get('/setting', [SettingController::class, 'index'])->name('setting');
    Route::post('/setting/update/profile', [SettingController::class, 'updateProfile']);
    Route::post('/setting/update/banner', [SettingController::class, 'updateBanner']);

});

//content
Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::get('/articles/{slug}', [ArticleController::class, 'getArticle']);

Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/{slug}', [ProjectController::class, 'getProject']);

Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes');

Route::get('/gallery', [GalleryController::class, 'index'])->name('photos');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{slug}', [ProductController::class, 'getProduct'])->name('get-product');

Route::fallback(function(){
    return redirect('/');
});
