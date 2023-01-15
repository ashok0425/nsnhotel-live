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
$router->group([
    'namespace' => 'Frontend',
    'middleware' => []], function () use ($router) {

 $router->get('/webhooks', 'WebHookController@webhook');
 $router->post('/webhooks', 'WebHookController@webhookPost');

 $router->get('/banquet', 'HomeController@banquote')->name('banquet');

    $router->get('/', 'HomeController@index')->name('home');
    $router->get('/copy-image/{start}/{end}', 'HomeController@copyImage');

    $router->get('popular_location', 'HomeController@popularLocation');

    $router->get('load-subcity', 'HomeController@subCity');

    $router->get('/sitemapCity.xml', 'sitemapController@sitemapCity');
    $router->get('/sitemapBlog.xml', 'sitemapController@sitemapBlog');
    $router->get('/sitemapHotel.xml/{slug}', 'sitemapController@sitemapHotel');
    $router->get('/sitemapindex.xml', 'sitemapController@index');
    $router->get('/blog/all', 'PostController@list')->name('post_list_all');
    $router->get('/blog/{cat_slug}', 'PostController@list')->where('cat_slug', '[a-zA-Z0-9-_]+')->name('post_list');
    $router->get('/post/{slug}-{id}', 'PostController@detail')
        ->where('slug', '[a-zA-Z0-9-_]+')
        ->where('id', '[0-9]+')->name('post_detail');

    $router->get('/page/contact', 'HomeController@pageContact')->name('page_contact');
       $router->get('/refer', 'HomeController@refer')->name('refer');
     $router->any('corporate', 'HomeController@corporate')->name('corporate');
    $router->post('/page/contact', 'HomeController@sendContact')->name('page_contact_send');

    $router->get('/page/landing/{page_number}', 'HomeController@pageLanding')->name('page_landing');

    $router->get('/city/{slug}', 'CityController@detail')->name('city_detail');
    $router->get('/city/{slug}/{cat_slug}', 'CityController@detail')->name('city_category_detail');

    $router->get('/hotels/{slug}/{id?}', 'PlaceController@detail')->name('place_detail');
    $router->get('/become-a-partner', 'PlaceController@pageAddNew')->name('become_a_partner');
    $router->get('/edit-place/{id}', 'PlaceController@pageAddNew')->name('place_edit')->middleware('auth');
    
    $router->get('/near-by-hotels', 'PlaceController@nearByHotels')->name('near_by_hotels');
    
    $router->post('/place', 'PlaceController@create')->name('place_create');
    $router->put('/place', 'PlaceController@update')->name('place_update')->middleware('auth');
    $router->get('/places/filter', 'PlaceController@getListFilter')->name('place_get_list_filter');

    $router->post('/review', 'ReviewController@create')->name('review_create')->middleware('auth');
     $router->post('/create-rating', 'ReviewController@createRating')->name('create_rating');
    $router->post('/wishlist', 'UserController@addWishlist')->name('add_wishlist')->middleware('auth');
    $router->delete('/wishlist', 'UserController@removeWishlist')->name('remove_wishlist')->middleware('auth');

    $router->get('/user/profile', 'UserController@pageProfile')->name('user_profile')->middleware('auth');
    $router->put('/user/profile', 'UserController@updateProfile')->name('user_profile_update')->middleware('auth');
    $router->put('/user/profile/password', 'UserController@updatePassword')->name('user_password_update')->middleware('auth');
    $router->get('/user/reset-password', 'UserController@pageResetPassword')->name('user_reset_password');
    $router->put('/user/reset-password', 'ResetPasswordController@reset')->name('user_update_password');
    $router->get('/user/my-place', 'UserController@pageMyPlace')->name('user_my_place')->middleware('auth');
    $router->get('/user/my-wallet', 'UserController@pageMyWallet')->name('user_my_wallet')->middleware('auth');
    
     $router->any('/user/thanku', 'UserController@thanku')->name('thanku')->middleware('auth');

    $router->get('/user/wishlist', 'UserController@pageWishList')->name('user_wishlist')->middleware('auth');


    $router->get('/book-now', 'BookingController@bookingPage')->name('book.now');
    $router->post('/bookings', 'BookingController@booking')->name('booking_submit');
    $router->get('/cancel-booking/{id}', 'BookingController@cancelBooking')->name('cancel_booking');
    $router->get('/load-booking-detail/{id}', 'BookingController@loadDetail');
    $router->get('recipt/{id}', 'BookingController@recipt')->name('recipt');
    


    $router->get('/auth/{social}', 'SocialAuthController@redirect')->name('login_social');
    $router->get('/auth/{social}/callback', 'SocialAuthController@callback')->name('login_social_callback');

    $router->get('/ajax-search', 'HomeController@ajaxSearch');
    $router->get('/ajax-search-listing', 'HomeController@searchListing');
    $router->get('/search', 'HomeController@search')->name('search');
    $router->get('/places/map', 'PlaceController@getListMap')->name('place_get_list_map');

    $router->get('/cities/{country_id}', 'CityController@getListByCountry')->name('city_get_list');
    $router->get('/cities', 'CityController@search')->name('city_search');
    $router->get('/location-search', 'HomeController@locationSearch')->name('location_search');

      $router->get('/search-listing', 'HomeController@pageSearchListing')->name('page_search_listing');
      
    $router->get('/city/{slug}', 'HomeController@pageSearchListing')->name('city-search');
    $router->get('/category/{slug}', 'CategoryController@listPlace')->name('category_list');

    $router->get('/categories', 'CategoryController@search')->name('category_search');

    $router->post('/checkout/payment', 'CheckoutController@checkout')->name('payment.checkout');
    $router->post('rozer/payment/pay-success/{booking_id}', 'RazorpayController@payment')->name('payment.rozer');
    $router->post('coupon', 'CheckoutController@checkCoupon')->name('check.coupon');
    $router->get('apply-offer', 'CheckoutController@applyoffer');

    
    $router->get('/user/login', 'UserController@loginPage')->name('user_login');
$router->get('/login', 'UserController@loginPage')->name('login');

    $router->get('/user/register', 'UserController@registerPage')->name('user_register');
    $router->post('/user/register', 'UserController@registerStore')->name('user_register');
    $router->post('loginWithOtp', 'UserController@loginWithOtp')->name('loginWithOtp');
    $router->post('sendOtp', 'UserController@sendOtp')->name('send_otp');
    $router->get('/setcookie', 'HomeController@setCookie')->name('set_cookie');
    $router->post('/subscribe', 'HomeController@subscribe')->name('subscribe');

    $router->post('review-store','HotelReviewController@store')->name('review.store');

    $router->post('review-reply','HotelReviewController@replyStore')->name('review.reply');
    $router->get('load-review/{place}','HotelReviewController@loadreview');


});

$router->group([
    'prefix' => 'admincp',
    'namespace' => 'Admin',
    'as' => 'admin_',
    'middleware' => ['auth', 'auth.admin']], function () use ($router) {

    $router->get('/', 'DashboardController@index')->name('dashboard');

    $router->get('/state', 'StateController@list')->name('state_list');
    $router->post('/store-review', 'PlaceController@storereview')->name('store_review');

    $router->post('/state', 'StateController@create')->name('state_create');
    $router->put('/state', 'StateController@update')->name('state_update');
    $router->delete('/state/{id}', 'StateController@destroy')->name('state_delete');
 $router->any('/sms', 'UserController@sms')->name('user_sms');
    $router->get('/city', 'CityController@list')->name('city_list');
        $router->any('/faq', 'CityController@faq')->name('faq');
           $router->any('/location', 'CityController@location')->name('location');
         $router->any('/add/location', 'CityController@alocation')->name('add_location');
         $router->any('/add/faq', 'CityController@add')->name('add_faq');
    $router->post('/city', 'CityController@create')->name('city_create');
    $router->get('/list-as-popular/{city}/{status}', 'CityController@ListPopular')->name('list-as-popular');

    $router->put('/city', 'CityController@update')->name('city_update');
    $router->put('/city/status', 'CityController@updateStatus')->name('city_update_status');
    $router->delete('/city/{id}', 'CityController@destroy')->name('city_delete');
    $router->delete('/faq/{id}', 'CityController@delete')->name('faq_delete');
 $router->delete('/location/{id}', 'CityController@remove')->name('location_delete');
    $router->get('/category/{type}', 'CategoryController@list')->name('category_list');
    $router->post('/category', 'CategoryController@create')->name('category_create');
    $router->put('/category', 'CategoryController@update')->name('category_update');
    $router->delete('/category/{id}', 'CategoryController@destroy')->name('category_delete');

    $router->get('/amenities', 'AmenitiesController@list')->name('amenities_list');
    $router->post('/amenities', 'AmenitiesController@create')->name('amenities_create');
    $router->put('/amenities', 'AmenitiesController@update')->name('amenities_update');
    $router->delete('/amenities/{id}', 'AmenitiesController@destroy')->name('amenities_delete');

    $router->get('/place-type', 'PlaceTypeController@list')->name('place_type_list');
    $router->delete('/place-type/{id}', 'PlaceTypeController@destroy')->name('place_type_delete');
    $router->post('/place-type', 'PlaceTypeController@create')->name('place_type_create');
    $router->put('/place-type', 'PlaceTypeController@update')->name('place_type_update');

    $router->get('/place', 'PlaceController@list')->name('place_list');
    $router->get('/custom-search', 'PlaceController@customSearch');
    $router->get('/place/add', 'PlaceController@createView')->name('place_create_view');
    $router->get('/place/edit/{id}', 'PlaceController@createView')->name('place_edit_view');
     $router->get('/place/room/{id}', 'PlaceController@createRoom')->name('place_add_rooms');
      $router->get('/place/book/{id}', 'PlaceController@createRoom')->name('place_book_rooms');
       $router->get('/place/recipt/{id}', 'PlaceController@createRoom')->name('place_book_rooms');
    $router->post('/place', 'PlaceController@create')->name('place_create');
    $router->put('/place', 'PlaceController@update')->name('place_update');
    $router->get('/place/{id}', 'PlaceController@destroy')->name('place_delete');


    $router->get('/room/{hotel_id}','RoomController@list')->name('room_list');
    $router->any('/room/{hotel_id}/add', 'RoomController@createView')->name('room_create_view');
    $router->any('/room/edit/{id}','RoomController@createView')->name('room_edit_view');

    $router->post('/room/{hotel_id}','RoomController@create')->name('room_create');
    $router->put('/room/{hotel_id}','RoomController@update')->name('room_update');
    $router->delete('/room/{id}', 'RoomController@destroy')->name('room_delete');
    $router->any('/add_calendar/{type}/{room_id}', 'RoomController@add_calendar')->name('add_calendar');

    $router->get('/bookings', 'BookingController@list')->name('booking_list');
    $router->get('/bookings-update', 'BookingController@updateStatus')->name('booking_update_status');
    $router->delete('/bookings/{id}', 'BookingController@destroy')->name('booking_delete');

    $router->get('/review', 'ReviewController@list')->name('review_list');
    $router->delete('/review', 'ReviewController@destroy')->name('review_delete');

    $router->get('/users/{latest?}', 'UserController@list')->name('user_list');
    $router->post('/users/create', 'UserController@store')->name('user_create');
    $router->post('/users/update', 'UserController@updateuser')->name('user_update');
     $router->delete('/users/{id}', 'UserController@destroy')->name('user_delete');

    $router->get('/blog', 'PostController@list')->name('post_list_blog');
    $router->get('/pages', 'PostController@list')->name('post_list_page');

    $router->get('/posts/add/{type}', 'PostController@pageCreate')->name('post_add');
    $router->get('/posts/{id}', 'PostController@pageCreate')->name('post_edit');
    $router->get('/corporate', 'PostController@corporate')->name('corporate_list');
     $router->any('/corporate/edit', 'PostController@updateCorporate')->name('edit-corporate');
    $router->post('/posts', 'PostController@create')->name('post_create');
    $router->put('/posts', 'PostController@update')->name('post_update');
    $router->delete('/posts/{id}', 'PostController@destroy')->name('post_delete');
    $router->get('/post-test', 'PostController@createPostTest');

    $router->get('/testimonials', 'TestimonialController@list')->name('testimonial_list');
    $router->get('/testimonials/add', 'TestimonialController@pageCreate')->name('testimonial_page_add');
    $router->get('/testimonials/edit/{id}', 'TestimonialController@pageCreate')->name('testimonial_page_edit');
    $router->post('/testimonials', 'TestimonialController@create')->name('testimonial_action');
    $router->put('/testimonials', 'TestimonialController@update')->name('testimonial_action');

   $router->get('/refer-view', 'ReferPriceController@index')->name('refer_index');
   $router->post('/add-refer', 'ReferPriceController@create')->name('refer_add');
   $router->get('/add-refer', 'ReferPriceController@create')->name('refer_delete');

    $router->get('/settings', 'SettingController@index')->name('settings');
    $router->post('/settings', 'SettingController@store')->name('setting_create');
    $router->get('/settings/language', 'SettingController@pageLanguage')->name('settings_language');
    $router->put('/settings/language/status/{code}', 'LanguageController@updateStatus')->name('settings_language_status');
    $router->put('/settings/language/default', 'LanguageController@updateStatus')->name('settings_language_default');

    $router->get('/index', 'MealController@index')->name('meal_index');
    $router->get('/mealTypeList', 'MealController@mealTypeList')->name('meal_TypeList');
    $router->put('/meal/update-status', 'MealController@updateStatus')->name('update_status');
    $router->post('/meal/create', 'MealController@create')->name('meal_create');
    $router->delete('/meal/{id}', 'MealController@destroy')->name('mealtype_delete');

    $router->get('/meal/tax-list', 'MealController@taxList')->name('tax_list');
    $router->post('/meal/tax-create', 'MealController@taxCreate')->name('tax_create');
    $router->delete('/meal/taxt/{id}', 'MealController@taxDestroy')->name('tax_destroy');
    $router->post('/meal/create-meal', 'MealController@createMeal')->name('create_meal');

    // coupon 
    $router->get('/offers/create', 'CouponController@pageCreate')->name('offer_create');
    $router->post('/offers/store', 'CouponController@create')->name('offer_store');
    $router->get('/offers/{id}', 'CouponController@edit')->name('offer_edit');
    $router->post('/offers/update', 'CouponController@update')->name('offer_update');
    $router->delete('/offers/{id}', 'CouponController@destroy')->name('offer_delete');
    $router->get('/offers', 'CouponController@index')->name('offer');

    // $router->get('/post-test', 'PostController@createPostTest');
});




$router->group([
    'prefix' => 'partnercp',
    'namespace' => 'Partner',
    'as' => 'partner_',
    'middleware' => ['auth', 'auth.partner']
], function () use ($router) {

    $router->get('/', 'DashboardController@index')->name('dashboard');

    $router->get('/category/{type}', 'CategoryController@list')->name('category_list');
    $router->post('/category', 'CategoryController@create')->name('category_create');
    $router->put('/category', 'CategoryController@update')->name('category_update');
    $router->delete('/category/{id}', 'CategoryController@destroy')->name('category_delete');
   $router->get('/detail', 'DashboardController@detail')->name('detail');
    $router->get('/amenities', 'AmenitiesController@list')->name('amenities_list');
    $router->post('/amenities', 'AmenitiesController@create')->name('amenities_create');
    $router->put('/amenities', 'AmenitiesController@update')->name('amenities_update');
    $router->delete('/amenities/{id}', 'AmenitiesController@destroy')->name('amenities_delete');

    $router->get('/place-type', 'PlaceTypeController@list')->name('place_type_list');
    $router->delete('/place-type/{id}', 'PlaceTypeController@destroy')->name('place_type_delete');
    $router->post('/place-type', 'PlaceTypeController@create')->name('place_type_create');
    $router->put('/place-type', 'PlaceTypeController@update')->name('place_type_update');

    $router->get('/place', 'PlaceController@list')->name('place_list');
    $router->get('/place/add', 'PlaceController@createView')->name('place_create_view');
    $router->get('/place/edit/{id}', 'PlaceController@createView')->name('place_edit_view');
    $router->post('/place', 'PlaceController@create')->name('place_create');
    $router->put('/place', 'PlaceController@update')->name('place_update');
    $router->delete('/place/{id}', 'PlaceController@destroy')->name('place_delete');


    $router->get('/room/{hotel_id}','RoomController@list')->name('room_list');
    $router->get('/room/{hotel_id}/add', 'RoomController@createView')->name('room_create_view');
    $router->get('/room/edit/{id}','RoomController@createView')->name('room_edit_view');
    $router->any('/add_calendar/{type}/{room_id}', 'RoomController@add_calendar')->name('add_calendar');

    $router->post('/room/{hotel_id}','RoomController@create')->name('room_create');
    $router->put('/room/{hotel_id}','RoomController@update')->name('room_update');
    

    $router->delete('/room/{id}', 'RoomController@destroy')->name('room_delete');

    $router->get('/bookings', 'BookingController@list')->name('booking_list');
    $router->put('/bookings', 'BookingController@updateStatus')->name('booking_update_status');
  $router->any('/sms', 'UserController@sms')->name('user_sms');
    $router->get('/index', 'MealController@index')->name('meal_index');
    $router->post('/meal/create', 'MealController@create')->name('meal_create');
    $router->delete('/meal/{id}', 'MealController@destroy')->name('meal_delete');
    $router->put('/meal/update-status', 'MealController@updateStatus')->name('update_status');

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


$router->get('/partnercp/login', 'Partner\UserController@loginPage')->name('partner_login');


$router->get('/admincp/login', 'Admin\UserController@loginPage')->name('admin_login');
$router->post('/admincp/register', 'Admin\UserController@storeUser')->name('admincp.register');

$router->get('/admincp/bq_list', 'Admin\UserController@bq_list')->name('admin_bq_user_list');





Route::get("sitemap.xml" , function () {
return \Illuminate\Support\Facades\Redirect::to('sitemap.xml');
 });


