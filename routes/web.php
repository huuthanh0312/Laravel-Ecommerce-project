<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('pages.index');
});


//Auth and User Route
Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('profile');

Route::get('/password/change','HomeController@changePassword')->name('password.change');

Route::post('/password/update','HomeController@updatePassword')->name('password.update');

Route::get('/user/logout','HomeController@Logout')->name('user.logout');

//Socalite Login Routes 
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');

Route::get('/callback/{provider}', 'SocialController@callback');


//Auth Admin Routes
Route::get('/admin/home','AdminController@index')->name('admin.home');

Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');

Route::post('admin','Admin\LoginController@login');

    // Password Reset Routes...

Route::get('admin/change/pasword','AdminController@changePassword')->name('admin.password.change');

Route::post('admin/update/pasword','AdminController@updatePassword')->name('admin.password.update');

Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');

Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');

Route::get('admin/logout','AdminController@logout')->name('admin.logout');


//Admin Category Pages Routes
Route::get('admin/categories','Admin\Category\CategoryController@index')->name('categories');

Route::post('admin/store/category','Admin\Category\CategoryController@storeCategory')->name('store.category');

Route::get('delete/category/{id}','Admin\Category\CategoryController@deleteCategory');

Route::get('edit/category/{id}','Admin\Category\CategoryController@editCategory');

Route::post('update/category/{id}','Admin\Category\CategoryController@updateCategory');


//Admin Brand Pages Routes
Route::get('admin/brands','Admin\Category\BrandController@index')->name('brands');

Route::post('admin/store/brand','Admin\Category\BrandController@storeBrand')->name('store.brand');

Route::get('delete/brand/{id}','Admin\Category\BrandController@deleteBrand');

Route::get('edit/brand/{id}','Admin\Category\BrandController@editBrand');

Route::post('update/brand/{id}','Admin\Category\BrandController@updateBrand');


//Admin Sub Category Pages Routes
Route::get('admin/subcategories','Admin\Category\SubCategoryController@index')->name('subcategories');

Route::post('admin/store/subcategory','Admin\Category\SubCategoryController@storeSubCategory')->name('store.subcategory');

Route::get('delete/subcategory/{id}','Admin\Category\SubCategoryController@deleteSubcategory');

Route::get('edit/subcategory/{id}','Admin\Category\SubCategoryController@editSubcategory');

Route::post('update/subcategory/{id}','Admin\Category\SubCategoryController@updateSubcategory');


//Admin Coupon Pages Routes
Route::get('admin/coupons','Admin\Category\CouponController@index')->name('admin.coupon');

Route::post('admin/store/coupons','Admin\Category\CouponController@storeCoupon')->name('store.coupon');

Route::get('delete/coupon/{id}','Admin\Category\CouponController@deleteCoupon');

Route::get('edit/coupon/{id}','Admin\Category\CouponController@editCoupon');

Route::post('update/coupon/{id}','Admin\Category\CouponController@updateCoupon');


//Admin Newslaters Pages Routes
Route::get('admin/newslater','Admin\Category\CouponController@Newslater')->name('admin.newslater');

Route::get('delete/newslater/{id}','Admin\Category\CouponController@deleteNewslater');

Route::delete('admin/delect/all','Admin\Category\CouponController@deleteAll')->name('deleteall');

// Admin For Show Sub Category with Ajax
Route::get('get/subcategory/{category_id}','Admin\ProductController@getSubcategory');


// Admin Product Pages Routes
Route::get('admin/product/all','Admin\ProductController@index')->name('all.product');

Route::get('admin/product/add','Admin\ProductController@createProduct')->name('add.product');

Route::post('admin/store/product','Admin\ProductController@storeProduct')->name('store.product');

Route::get('inactive/product/{id}','Admin\ProductController@inactive');

Route::get('active/product/{id}','Admin\ProductController@active');

Route::get('delete/product/{id}','Admin\ProductController@deleteProduct');

Route::get('view/product/{id}','Admin\ProductController@viewProduct');

Route::get('edit/product/{id}','Admin\ProductController@editProduct');

Route::post('update/product/withoutphoto/{id}','Admin\ProductController@updateProductWithoutPhoto');

Route::post('update/product/photo/{id}','Admin\ProductController@updateProductPhoto');


// Admin Blog Pages Routes
Route::get('admin/blog/category/list','Admin\PostController@blogCatList')->name('list.blog.category');

Route::post('admin/store/category/blog','Admin\PostController@blogCatStore')->name('store.blog.category');

Route::get('delete/category/blog/{id}','Admin\PostController@blogCatDelete');

Route::get('edit/category/blog/{id}','Admin\PostController@blogCatEdit');

Route::post('update/category/blog/{id}','Admin\PostController@blogCatUpdate');

Route::get('admin/add/post','Admin\PostController@createPost')->name('add.blogpost');

Route::post('admin/store/post','Admin\PostController@storePost')->name('store.blogpost');

Route::get('admin/all/post','Admin\PostController@index')->name('all.blogpost');

Route::get('delete/post/{id}','Admin\PostController@deletePost');

Route::get('edit/post/{id}','Admin\PostController@editPost');

Route::post('update/post/{id}','Admin\PostController@updatePost');

//Admin Order Pages Routes

Route::get('admin/pending/order','Admin\OrderController@newOrder')->name('admin.neworder');

Route::get('admin/view/order/{id}','Admin\OrderController@viewOrder');

Route::get('admin/payment/accept/{id}','Admin\OrderController@acceptPayment');

Route::get('admin/payment/cancel/{id}','Admin\OrderController@canelPayment');

Route::get('admin/delevery/process/{id}','Admin\OrderController@deleveryProcess');

Route::get('admin/delevery/done/{id}','Admin\OrderController@deleveryDone');

Route::get('admin/accept/payment','Admin\OrderController@viewAcceptPayment')->name('admin.accept.payment');

Route::get('admin/cancel/payment','Admin\OrderController@viewCancelOrder')->name('admin.cancel.payment');

Route::get('admin/process/payment','Admin\OrderController@viewProcessOrder')->name('admin.process.payment');

Route::get('admin/success/payment','Admin\OrderController@viewSuccessOrder')->name('admin.success.payment');

//Admin Seo Pages Routes
Route::get('admin/seo','Admin\OrderController@seo')->name('admin.seo');

Route::post('admin/update/seo','Admin\OrderController@updateSeo')->name('update.seo');

//Admin Report Pages Routes

Route::get('admin/today/order','Admin\ReportController@todayOrder')->name('today.order');

Route::get('admin/today/delivery','Admin\ReportController@todayDelivery')->name('today.delivery');

Route::get('admin/report/thismonth','Admin\ReportController@thisMonth')->name('this.month');

Route::get('admin/search/report','Admin\ReportController@search')->name('report.search');

Route::post('admin/search/by/date','Admin\ReportController@searchByDate')->name('search.by.date');

Route::post('admin/search/by/month','Admin\ReportController@searchByMonth')->name('search.by.month');

Route::post('admin/search/by/year','Admin\ReportController@searchByYear')->name('search.by.year');

//Admin Role User Pages Routes

Route::get('admin/all/user/role/','Admin\UserRoleController@allUserRole')->name('admin.all.user');

Route::get('admin/create/user/role/','Admin\UserRoleController@addUserRole')->name('admin.add.user');

Route::post('admin/store/user/role/','Admin\UserRoleController@storeUserRole')->name('admin.store.user');

Route::get('delete/user/role/{id}','Admin\UserRoleController@deleteUserRole');

Route::get('edit/user/role/{id}','Admin\UserRoleController@editUserRole');

Route::post('update/user/role/{id}','Admin\UserRoleController@updateUserRole');

//Admin Site Settings Routes

Route::get('admin/site-setting' , 'Admin\SettingController@siteSetting')->name('admin.site.setting');

Route::post('admin/update/site' , 'Admin\SettingController@updateSiteSetting')->name('update.site.setting');

//Admin Return Order Routes

Route::get('admin/return/request','Admin\ReturnController@returnRequest')->name('admin.return.request');

Route::get('admin/approve/request/{id}','Admin\ReturnController@approveRequest');

Route::get('admin/all/request','Admin\ReturnController@allRequest')->name('admin.all.request');

//Admin Stock Pages Routes

Route::get('admin/product/stock','Admin\ProductController@productStock')->name('admin.product.stock');

//Admin Contact Pages Routes

Route::get('admin/all/message','Admin\ContactController@allMessage')->name('admin.all.message');

Route::get('admin/message/{id}','Admin\ContactController@viewMessage');





//Front Pages Routes
Route::post('store/newslater','FrontController@storeNewslater')->name('store.newslater');

//WishList Add Routes
Route::get('add/wishlist/{id}','WishlistController@addWishlist');

Route::get('view/wishlist','WishlistController@viewWishList')->name('user.wishlist');

Route::get('delete/wishlist/{id}','WishlistController@deleteWishlist');

//Cart Add Routes
Route::get('add/cart/{id}','CartController@addCart');

Route::get('check','CartController@check');

Route::get('cart','CartController@showCart')->name('show.cart');

Route::get('remove/cart/{id}','CartController@removeCart');

Route::post('update/cart/item/','CartController@updateCart')->name('update.cartitem');

Route::get('view/product/cart/{id}','CartController@viewProduct');

Route::post('insert/into/cart/', 'CartController@insertCart')->name('insert.into.cart');

Route::get('user/checkout', 'CartController@checkout')->name('user.checkout');


    //Coupon routes discount prices
Route::post('user/apply/coupon', 'CartController@applyCoupon')->name('apply.coupon');

Route::get('remove/coupon', 'CartController@removeCoupon')->name('remove.coupon');

    //Payment Cart Routes
Route::get('payment/page', 'CartController@paymentPage')->name('payment.page');

Route::post('user/payment/process','PaymentController@paymentProcess')->name('payment.process');

Route::post('user/stripe/charge','PaymentController@stripeCharge')->name('stripe.charge');

Route::post('user/paypal/charge','PaymentController@paypalCharge')->name('paypal.charge');

Route::post('user/oncash/charge','PaymentController@oncashCharge')->name('oncash.charge');


//Product User All Routes
Route::get('product/details/{id}/{product_name}','ProductController@detailShowProduct');

Route::post('cart/product/add/{id}','ProductController@addProduct');

Route::get('products/{id}','ProductController@viewSubCatProduct');

Route::get('category/product/{id}','ProductController@viewCatProduct');


//Blog Post All Routes
Route::get('blog/post', 'BlogController@blog')->name('blog.post');

Route::get('language/english', 'BlogController@english')->name('language.english');

Route::get('language/vietnam', 'BlogController@vietnam')->name('language.vietnam');

Route::get('blog/single/{id}', 'BlogController@singleBlog');


//Order Tracking Pages Routes

Route::post('order/tracking', 'FrontController@orderTracking')->name('order.tracking');

//Return Order Routes

Route::get('order/return/list', 'FrontController@successOrderList')->name('success.orderlist');

Route::get('request/return/{id}', 'FrontController@requestReturn');

//Contact Pages Routes

Route::get('contact/page', 'ContactController@contact')->name('contact.page');

Route::post('contact/form', 'ContactController@contactForm')->name('contact.form');

//Search Product Routes 

Route::post('search/', 'FrontController@search')->name('search.product');

