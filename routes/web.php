<?php

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

Auth::routes();


/**
 * Frontend Router
 */


Route::group([
    'namespace' => 'Frontend',
    'middleware' => []], function () use ($router) {
    Route::get('/mapapi', 'HomeController@mapapi');

 Route::get('/webhooks', 'WebHookController@webhook');
 Route::post('/webhooks', 'WebHookController@webhookPost');

 Route::get('/banquet', 'HomeController@banquote')->name('banquet');

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/copy-image/{start}/{end}', 'HomeController@copyImage');

    Route::get('popular_location', 'HomeController@popularLocation');

    Route::get('load-subcity', 'HomeController@subCity');

    Route::get('/sitemapCity.xml', 'sitemapController@sitemapCity');
    Route::get('/sitemapBlog.xml', 'sitemapController@sitemapBlog');
    Route::get('/sitemapHotel.xml/{slug}', 'sitemapController@sitemapHotel');
    Route::get('/sitemapindex.xml', 'sitemapController@index');
    Route::get('/blog/all', 'PostController@list')->name('post_list_all');
    Route::get('/blog/{cat_slug}', 'PostController@list')->where('cat_slug', '[a-zA-Z0-9-_]+')->name('post_list');
    Route::get('/post/{slug}-{id}', 'PostController@detail')
        ->where('slug', '[a-zA-Z0-9-_]+')
        ->where('id', '[0-9]+')->name('post_detail');

    Route::get('/page/contact', 'HomeController@pageContact')->name('page_contact');
       Route::get('/refer', 'HomeController@refer')->name('refer');
     Route::any('corporate', 'HomeController@corporate')->name('corporate');
    Route::post('/page/contact', 'HomeController@sendContact')->name('page_contact_send');

    Route::get('/page/landing/{page_number}', 'HomeController@pageLanding')->name('page_landing');

    Route::get('/city/{slug}', 'CityController@detail')->name('city_detail');
    Route::get('/city/{slug}/{cat_slug}', 'CityController@detail')->name('city_category_detail');

    Route::get('/hotels/{slug}/{id?}', 'PlaceController@detail')->name('place_detail');
    Route::get('/become-a-partner', 'PlaceController@pageAddNew')->name('become_a_partner');
    Route::get('/edit-place/{id}', 'PlaceController@pageAddNew')->name('place_edit')->middleware('auth');
    
    Route::get('/near-by-hotels', 'PlaceController@nearByHotels')->name('near_by_hotels');
    
    Route::post('/place', 'PlaceController@create')->name('place_create');
    Route::put('/place', 'PlaceController@update')->name('place_update')->middleware('auth');
    Route::get('/places/filter', 'PlaceController@getListFilter')->name('place_get_list_filter');

    Route::post('/review', 'ReviewController@create')->name('review_create')->middleware('auth');
     Route::post('/create-rating', 'ReviewController@createRating')->name('create_rating');
    Route::post('/wishlist', 'UserController@addWishlist')->name('add_wishlist')->middleware('auth');
    Route::delete('/wishlist', 'UserController@removeWishlist')->name('remove_wishlist')->middleware('auth');

    Route::get('/user/profile', 'UserController@pageProfile')->name('user_profile')->middleware('auth');
    Route::put('/user/profile', 'UserController@updateProfile')->name('user_profile_update')->middleware('auth');
    Route::put('/user/profile/password', 'UserController@updatePassword')->name('user_password_update')->middleware('auth');
    Route::get('/user/reset-password', 'UserController@pageResetPassword')->name('user_reset_password');
    Route::put('/user/reset-password', 'ResetPasswordController@reset')->name('user_update_password');
    Route::get('/user/my-place', 'UserController@pageMyPlace')->name('user_my_place')->middleware('auth');
    Route::get('/user/my-wallet', 'UserController@pageMyWallet')->name('user_my_wallet')->middleware('auth');
    
     Route::any('/user/thanku', 'UserController@thanku')->name('thanku')->middleware('auth');

    Route::get('/user/wishlist', 'UserController@pageWishList')->name('user_wishlist')->middleware('auth');


    Route::get('/book-now', 'BookingController@bookingPage')->name('book.now');
    Route::post('/bookings', 'BookingController@booking')->name('booking_submit');
    Route::get('/cancel-booking/{id}', 'BookingController@cancelBooking')->name('cancel_booking');
    Route::get('/load-booking-detail/{id}', 'BookingController@loadDetail');
    Route::get('recipt/{id}', 'BookingController@recipt')->name('recipt');
    


    Route::get('/auth/{social}', 'SocialAuthController@redirect')->name('login_social');
    Route::get('/auth/{social}/callback', 'SocialAuthController@callback')->name('login_social_callback');

    Route::get('/ajax-search', 'HomeController@ajaxSearch');
    Route::get('/ajax-search-listing', 'HomeController@searchListing');
    Route::get('/search', 'HomeController@search')->name('search');
    Route::get('/places/map', 'PlaceController@getListMap')->name('place_get_list_map');

    Route::get('/cities/{country_id}', 'CityController@getListByCountry')->name('city_get_list');
    Route::get('/cities', 'CityController@search')->name('city_search');
    Route::get('/location-search', 'HomeController@locationSearch')->name('location_search');

      Route::get('/search-listing', 'HomeController@pageSearchListing')->name('page_search_listing');
      
    Route::get('/city/{slug}', 'HomeController@pageSearchListing')->name('city-search');
    Route::get('/category/{slug}', 'CategoryController@listPlace')->name('category_list');

    Route::get('/categories', 'CategoryController@search')->name('category_search');

    Route::post('/checkout/payment', 'CheckoutController@checkout')->name('payment.checkout');
    Route::post('rozer/payment/pay-success/{booking_id}', 'RazorpayController@payment')->name('payment.rozer');
    Route::post('coupon', 'CheckoutController@checkCoupon')->name('check.coupon');
    Route::get('apply-offer', 'CheckoutController@applyoffer');

    
    Route::get('/user/login', 'UserController@loginPage')->name('user_login');
Route::get('/login', 'UserController@loginPage')->name('login');

    Route::get('/user/register', 'UserController@registerPage')->name('user_register');
    Route::post('/user/register', 'UserController@registerStore')->name('user_register');
    Route::post('loginWithOtp', 'UserController@loginWithOtp')->name('loginWithOtp');
    Route::post('sendOtp', 'UserController@sendOtp')->name('send_otp');
    Route::get('/setcookie', 'HomeController@setCookie')->name('set_cookie');
    Route::post('/subscribe', 'HomeController@subscribe')->name('subscribe');

    Route::post('review-store','HotelReviewController@store')->name('review.store');

    Route::post('review-reply','HotelReviewController@replyStore')->name('review.reply');
    Route::get('load-review/{place}','HotelReviewController@loadreview');


});

Route::group([
    'prefix' => 'admincp',
    'namespace' => 'Admin',
    'as' => 'admin_',
    'middleware' => ['auth', 'auth.admin']], function () use ($router) {

    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/other/{id}', 'DashboardController@other')->name('other');
    Route::get('/modify-price', 'CityController@ModifyPrice')->name('modify_price');



    Route::get('/state', 'StateController@list')->name('state_list');
    Route::post('/store-review', 'PlaceController@storereview')->name('store_review');

    Route::post('/state', 'StateController@create')->name('state_create');
    Route::put('/state', 'StateController@update')->name('state_update');
    Route::delete('/state/{id}', 'StateController@destroy')->name('state_delete');
 Route::any('/sms', 'UserController@sms')->name('user_sms');
    Route::get('/city', 'CityController@list')->name('city_list');
        Route::any('/faq', 'CityController@faq')->name('faq');
           Route::any('/location', 'CityController@location')->name('location');
         Route::any('/add/location', 'CityController@alocation')->name('add_location');
         Route::any('/add/faq', 'CityController@add')->name('add_faq');
    Route::post('/city', 'CityController@create')->name('city_create');
    Route::get('/list-as-popular/{city}/{status}', 'CityController@ListPopular')->name('list-as-popular');

    Route::put('/city', 'CityController@update')->name('city_update');
    Route::put('/city/status', 'CityController@updateStatus')->name('city_update_status');
    Route::delete('/city/{id}', 'CityController@destroy')->name('city_delete');
    Route::delete('/faq/{id}', 'CityController@delete')->name('faq_delete');
 Route::delete('/location/{id}', 'CityController@remove')->name('location_delete');
    Route::get('/category/{type}', 'CategoryController@list')->name('category_list');
    Route::post('/category', 'CategoryController@create')->name('category_create');
    Route::put('/category', 'CategoryController@update')->name('category_update');
    Route::delete('/category/{id}', 'CategoryController@destroy')->name('category_delete');

    Route::get('/amenities', 'AmenitiesController@list')->name('amenities_list');
    Route::post('/amenities', 'AmenitiesController@create')->name('amenities_create');
    Route::put('/amenities', 'AmenitiesController@update')->name('amenities_update');
    Route::delete('/amenities/{id}', 'AmenitiesController@destroy')->name('amenities_delete');

    Route::get('/place-type', 'PlaceTypeController@list')->name('place_type_list');
    Route::delete('/place-type/{id}', 'PlaceTypeController@destroy')->name('place_type_delete');
    Route::post('/place-type', 'PlaceTypeController@create')->name('place_type_create');
    Route::put('/place-type', 'PlaceTypeController@update')->name('place_type_update');

    Route::get('/place', 'PlaceController@list')->name('place_list');
    Route::get('/custom-search', 'PlaceController@customSearch');
    Route::get('/place/add', 'PlaceController@createView')->name('place_create_view');
    Route::get('/place/edit/{id}', 'PlaceController@createView')->name('place_edit_view');
     Route::get('/place/room/{id}', 'PlaceController@createRoom')->name('place_add_rooms');
      Route::get('/place/book/{id}', 'PlaceController@createRoom')->name('place_book_rooms');
       Route::get('/place/recipt/{id}', 'PlaceController@createRoom')->name('place_book_rooms');
    Route::post('/place', 'PlaceController@create')->name('place_create');
    Route::put('/place', 'PlaceController@update')->name('place_update');
    Route::get('/place/{id}', 'PlaceController@destroy')->name('place_delete');


    Route::get('/room/{hotel_id}','RoomController@list')->name('room_list');
    Route::any('/room/{hotel_id}/add', 'RoomController@createView')->name('room_create_view');
    Route::any('/room/edit/{id}','RoomController@createView')->name('room_edit_view');

    Route::post('/room/{hotel_id}','RoomController@create')->name('room_create');
    Route::put('/room/{hotel_id}','RoomController@update')->name('room_update');
    Route::delete('/room/{id}', 'RoomController@destroy')->name('room_delete');
    Route::any('/add_calendar/{type}/{room_id}', 'RoomController@add_calendar')->name('add_calendar');

    Route::get('/bookings', 'BookingController@list')->name('booking_list');
    Route::get('/bookings-update', 'BookingController@updateStatus')->name('booking_update_status');
    Route::delete('/bookings/{id}', 'BookingController@destroy')->name('booking_delete');

    Route::get('/review', 'ReviewController@list')->name('review_list');
    Route::delete('/review', 'ReviewController@destroy')->name('review_delete');

    Route::get('/users/{latest?}', 'UserController@list')->name('user_list');
    Route::post('/users/create', 'UserController@store')->name('user_create');
    Route::post('/users/update', 'UserController@updateuser')->name('user_update');
     Route::delete('/users/{id}', 'UserController@destroy')->name('user_delete');

    Route::get('/blog', 'PostController@list')->name('post_list_blog');
    Route::get('/pages', 'PostController@list')->name('post_list_page');

    Route::get('/posts/add/{type}', 'PostController@pageCreate')->name('post_add');
    Route::get('/posts/{id}', 'PostController@pageCreate')->name('post_edit');
    Route::get('/corporate', 'PostController@corporate')->name('corporate_list');
     Route::any('/corporate/edit', 'PostController@updateCorporate')->name('edit-corporate');
    Route::post('/posts', 'PostController@create')->name('post_create');
    Route::put('/posts', 'PostController@update')->name('post_update');
    Route::delete('/posts/{id}', 'PostController@destroy')->name('post_delete');
    Route::get('/post-test', 'PostController@createPostTest');

    Route::get('/testimonials', 'TestimonialController@list')->name('testimonial_list');
    Route::get('/testimonials/add', 'TestimonialController@pageCreate')->name('testimonial_page_add');
    Route::get('/testimonials/edit/{id}', 'TestimonialController@pageCreate')->name('testimonial_page_edit');
    Route::post('/testimonials', 'TestimonialController@create')->name('testimonial_action');
    Route::put('/testimonials', 'TestimonialController@update')->name('testimonial_action');

   Route::get('/refer-view', 'ReferPriceController@index')->name('refer_index');
   Route::post('/add-refer', 'ReferPriceController@create')->name('refer_add');
   Route::get('/add-refer', 'ReferPriceController@create')->name('refer_delete');

    Route::get('/settings', 'SettingController@index')->name('settings');
    Route::post('/settings', 'SettingController@store')->name('setting_create');
    Route::get('/settings/language', 'SettingController@pageLanguage')->name('settings_language');
    Route::put('/settings/language/status/{code}', 'LanguageController@updateStatus')->name('settings_language_status');
    Route::put('/settings/language/default', 'LanguageController@updateStatus')->name('settings_language_default');

    Route::get('/index', 'MealController@index')->name('meal_index');
    Route::get('/mealTypeList', 'MealController@mealTypeList')->name('meal_TypeList');
    Route::put('/meal/update-status', 'MealController@updateStatus')->name('update_status');
    Route::post('/meal/create', 'MealController@create')->name('meal_create');
    Route::delete('/meal/{id}', 'MealController@destroy')->name('mealtype_delete');

    Route::get('/meal/tax-list', 'MealController@taxList')->name('tax_list');
    Route::post('/meal/tax-create', 'MealController@taxCreate')->name('tax_create');
    Route::get('/tax-edit/{id}', 'MealController@editTax')->name('tax_edit');
    Route::post('/tax-update', 'MealController@taxupdate')->name('tax_update');


    Route::delete('/meal/taxt/{id}', 'MealController@taxDestroy')->name('tax_destroy');
    Route::post('/meal/create-meal', 'MealController@createMeal')->name('create_meal');

    // coupon 
    Route::get('/offers/create', 'CouponController@pageCreate')->name('offer_create');
    Route::post('/offers/store', 'CouponController@create')->name('offer_store');
    Route::get('/offers/{id}', 'CouponController@edit')->name('offer_edit');
    Route::post('/offers/update', 'CouponController@update')->name('offer_update');
    Route::delete('/offers/{id}', 'CouponController@destroy')->name('offer_delete');
    Route::get('/offers', 'CouponController@index')->name('offer');

    // Route::get('/post-test', 'PostController@createPostTest');
});




Route::group([
    'prefix' => 'partnercp',
    'namespace' => 'Partner',
    'as' => 'partner_',
    'middleware' => ['auth', 'auth.partner']
], function () use ($router) {

    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('/category/{type}', 'CategoryController@list')->name('category_list');
    Route::post('/category', 'CategoryController@create')->name('category_create');
    Route::put('/category', 'CategoryController@update')->name('category_update');
    Route::delete('/category/{id}', 'CategoryController@destroy')->name('category_delete');
   Route::get('/detail', 'DashboardController@detail')->name('detail');
    Route::get('/amenities', 'AmenitiesController@list')->name('amenities_list');
    Route::post('/amenities', 'AmenitiesController@create')->name('amenities_create');
    Route::put('/amenities', 'AmenitiesController@update')->name('amenities_update');
    Route::delete('/amenities/{id}', 'AmenitiesController@destroy')->name('amenities_delete');

    Route::get('/place-type', 'PlaceTypeController@list')->name('place_type_list');
    Route::delete('/place-type/{id}', 'PlaceTypeController@destroy')->name('place_type_delete');
    Route::post('/place-type', 'PlaceTypeController@create')->name('place_type_create');
    Route::put('/place-type', 'PlaceTypeController@update')->name('place_type_update');

    Route::get('/place', 'PlaceController@list')->name('place_list');
    Route::get('/place/add', 'PlaceController@createView')->name('place_create_view');
    Route::get('/place/edit/{id}', 'PlaceController@createView')->name('place_edit_view');
    Route::post('/place', 'PlaceController@create')->name('place_create');
    Route::put('/place', 'PlaceController@update')->name('place_update');
    Route::delete('/place/{id}', 'PlaceController@destroy')->name('place_delete');


    Route::get('/room/{hotel_id}','RoomController@list')->name('room_list');
    Route::get('/room/{hotel_id}/add', 'RoomController@createView')->name('room_create_view');
    Route::get('/room/edit/{id}','RoomController@createView')->name('room_edit_view');
    Route::any('/add_calendar/{type}/{room_id}', 'RoomController@add_calendar')->name('add_calendar');

    Route::post('/room/{hotel_id}','RoomController@create')->name('room_create');
    Route::put('/room/{hotel_id}','RoomController@update')->name('room_update');
    

    Route::delete('/room/{id}', 'RoomController@destroy')->name('room_delete');

    Route::get('/bookings', 'BookingController@list')->name('booking_list');
    Route::put('/bookings', 'BookingController@updateStatus')->name('booking_update_status');
  Route::any('/sms', 'UserController@sms')->name('user_sms');
    Route::get('/index', 'MealController@index')->name('meal_index');
    Route::post('/meal/create', 'MealController@create')->name('meal_create');
    Route::delete('/meal/{id}', 'MealController@destroy')->name('meal_delete');
    Route::put('/meal/update-status', 'MealController@updateStatus')->name('update_status');

});


// Remove route cache
// Route::get('/clear-route-cache', function() {
//     $exitCode = Artisan::call('route:cache');
//     return 'All routes cache has just been removed';
// });

// //Remove config cache
// Route::get('/clear-config-cache', function() {
//     $exitCode = Artisan::call('config:cache');
//     return 'Config cache has just been removed';
// }); 
// Remove application cache
Route::get('/clear-app-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache has just been removed';
});

// Remove view cache
Route::get('/clear-view-cache', function() {
    $exitCode = Artisan::call('view:clear');
    return 'View cache has jut been removed';
});


Route::get('/partnercp/login', 'Partner\UserController@loginPage')->name('partner_login');


Route::get('/admincp/login', 'Admin\UserController@loginPage')->name('admin_login');
Route::post('/admincp/register', 'Admin\UserController@storeUser')->name('admincp.register');

Route::get('/admincp/bq_list', 'Admin\UserController@bq_list')->name('admin_bq_user_list');





Route::get("sitemap.xml" , function () {
return \Illuminate\Support\Facades\Redirect::to('sitemap.xml');
 });


