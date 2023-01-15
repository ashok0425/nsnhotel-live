<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$router->group([
    'as' => 'api_',
    'middleware' => []], function () use ($router) {

    $router->post('/upload-image', 'ImageController@upload')->name('upload_image');

    $router->get('/cities', 'Frontend\CityController@search')->name('city_search');
    $router->put('/city/status', 'Admin\CityController@updateStatus')->name('city_update_status');
    $router->get('/cities/{country_id}', 'Admin\CityController@getListByCountry')->name('city_get_list');

    $router->get('/categories', 'Frontend\CategoryController@search')->name('category_search');
    $router->put('/category/status', 'Admin\CategoryController@updateStatus')->name('category_update_status');
    $router->put('/category/is-feature', 'Admin\CategoryController@updateIsFeature')->name('category_update_is_feature');

    $router->put('/places/status', 'Admin\PlaceController@updateStatus')->name('place_update_status');

    $router->put('/reviews/status', 'Admin\ReviewController@updateStatus')->name('review_update_status');


    $router->put('/posts/status', 'Admin\PostController@updateStatus')->name('post_update_status');

   
    $router->put('/users/status', 'Admin\UserController@updateStatus')->name('user_update_status');
    $router->put('/users/role/admin', 'Admin\UserController@updateRoleAdmin')->name('user_update_role_admin');
    $router->put('/users/role/partner', 'Admin\UserController@updateRolePartner')->name('user_update_role_partner');

    $router->put('/languages/default', 'Admin\LanguageController@setDefault')->name('language_set_default');

    $router->post('/user/reset-password', 'Frontend\ResetPasswordController@sendMail')->name('user_forgot_password');
});


$router->group([
    'prefix' => 'app',
    'namespace' => 'API',
    'as' => 'api_app_',
    'middleware' => []], function () use ($router) {

    $router->get('/cities/{ishomepage?}', 'CityController@list');
    $router->get('/cities/{id}', 'CityController@detail');
    $router->get('/cities/popular', 'CityController@popularCity');
    $router->get('/posts/inspiration', 'PostController@postInspiration');
    $router->get('/placebycity/{city_id}', 'PlaceController@placeBycity');
    $router->get('/places/{id}', 'PlaceController@detail');
    $router->get('/placesbytype/{type_id}/{is_toprated?}', 'PlaceController@PlaceBytype');
    $router->get('/places-search', 'PlaceController@search');
    $router->get('/location/search', 'PlaceController@locationSearch');
    $router->get('/nearbyplace', 'PlaceController@nearbyplace');
    $router->get('/testimonial', 'CustomerController@Testimonial');
    $router->get('/banners', 'CityController@Bannerlist');
    
    $router->post('customer/registers','CustomerController@register');
    $router->post('customer/login','CustomerController@loginCustomer');
    $router->post('send/otp','CustomerController@sendOtp');
    $router->post('verify/login','CustomerController@getLogin');
    $router->middleware(['Hastoken'])->group(function () use ($router) {
        $router->post('update/profile/customer','UpdateController@updateCustomerProfile');
         $router->post('room/booking','BookingController@bookRoom');
           $router->post('/checkout','CheckoutController@store');
           $router->post('/update-checkout','CheckoutController@updateAfterPayment');
           $router->get('/users', 'UserController@getUserInfo');
           $router->get('/coupon', 'CheckoutController@Coupon');
           $router->get('/booking-list', 'CustomerController@mybooking');
           $router->get('/cancel-booking', 'CustomerController@cancelBooking');

    });

    
    // $router->get('/users/{user_id}/place', 'UserController@getPlaceByUser');
    // $router->get('/users/{user_id}/place/wishlist', 'UserController@getPlaceByUser');
    // $router->post('/users/reset-password', 'Frontend\ResetPasswordController@sendMail')->name('user_forgot_password');
    // $router->post('/places/wishlist', 'PlaceController@addPlaceToWishlist')->middleware('auth:api');
    // $router->delete('/places/wishlist', 'PlaceController@removePlaceFromWishlist')->middleware('auth:api');
//     $router->post('addhotel', 'HotelController@addHotel');
//     $router->post('addroom', 'HotelController@addRoom');
//     $router->post('addreception', 'ReceptionController@addReception');
    
//     // Reception 
//    $router->post('checkin/list/byreception', 'ReceptionController@viewCheckin');
//    $router->post('checkout/list/byreception', 'ReceptionController@viewCheckout');
//    $router->post('bookinglist/byreception','ReceptionController@bookingListByReception');
//    $router->post('canclelist/byreception','ReceptionController@cancleListByReception');
//    $router->post('complete/booking/byreception','ReceptionController@completedBooking');

//    //ByHotel
//    $router->post('bookinglist/byhotel','HotelController@bookingListByHotel');
//    $router->post('canclelist/byhotel','HotelController@viewCancleByHotel');
//    $router->post('guestlist/byhotel', 'HotelController@guestListByHotel');
//    $router->post('checkout/byhotel', 'HotelController@checkoutListByHotel');
//    $router->post('complete/booking/byhotel','HotelController@completedBookingByHotel');
//    $router->post('room/booked/unbooked','HotelController@bookedunbookedList');
  
    
//     //By Customer
//    $router->post('view/booking/bycustomer','BookingController@viewBookingDeatils');
//    $router->post('view/allbooking/bycustomer','BookingController@viewAllBookingDeatils');
//    $router->post('booking/cancelByCustomer','BookingController@makeBookingCancel');

//    $router->post('booking/byCustomer','BookingController@bookingStatusByCustomer');
//    $router->post('checkin/byCustomer','BookingController@checkinStatusByCustomer');
//    $router->post('checkout/byCustomer','BookingController@checkoutStatusByCustomer');
//    $router->post('cancle/byCustomer','BookingController@cancleStatusByCustomer');


//    $router->post('all/city','BookingController@allCity');
//    $router->post('all/offer','BookingController@allOffers');

//    $router->post('home/hotel','BookingController@homeHotel');
//    $router->post('customer/hotels','BookingController@allHotels');
//    $router->post('upload/image','HotelController@uploadImage');
//    $router->post('room/details','BookingController@roomDetails');
//    $router->post('hotel/bylocation','BookingController@searchByLocation');
//    $router->post('make/checkin/byreception','BookingController@makeChekin');
//    $router->post('make/checkout/byreception','BookingController@makeChekOut');
//    $router->post('get/allhotels','BookingController@getallHotels');
//    $router->post('save/rating','BookingController@saveRating');
    
//   $router->post('receptionlist/bypartner','HotelController@getReceptionList');
//   $router->post('roomlist/bypartner','HotelController@getRoomList');
//   $router->post('update/profile/partner','UpdateController@partnerProfileUpdate');
//   $router->post('update/profile/hotel','UpdateController@updateHotelProfile');
//   $router->post('update/profile/reception','UpdateController@updateReceptionProfile');
//   $router->post('delete/hotel','UpdateController@hotelDelete');
//   $router->post('delete/room','UpdateController@RoomDelete');
//   $router->post('delete/reception','UpdateController@ReceptionDelete');
//   $router->post('viewOffer','BookingController@viewOffer');
//   $router->post('viewtop/recomanded','BookingController@viewtopRated');
//   $router->post('get/payment','BookingController@paymentStatus');
});
