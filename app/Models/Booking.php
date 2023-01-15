<?php

namespace App\Models;
use Razorpay\Api\Api;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $guarded = ['id'];

    protected $hidden = [];

    protected $casts = [
        'user_id' => 'integer',
        'place_id' => 'integer',
        'numbber_of_adult' => 'integer',
        'numbber_of_children' => 'integer',
        'type' => 'integer',
        'status' => 'integer'
    ];
    
    
    public function verifyBooking($data)
    {
    	if ($data->fails()) {
                $errors = $data->errors()->all();
                $errors = implode(" ",$errors);
                $success = [ 'error' => true,
                        'message' => $errors,];
                return $success;
            }
        return false;   
    }
    
    public function makePayment($data)
    {
        $api_key = "rzp_live_eiFoCLNPbiIdeD";
        $api_secret = "TviDqeTjVzGvfU50LvUi8TeI";
        //$client = new Client;    
        $api = new Api($api_key, $api_secret);
        $amount = (int)$data['amount'];
        $newcustomer = User::find($data['customer_id']);
        
        if($newcustomer['razorpay_customer_id'] == null)
        {
            try 
            {
                $customer = $api->customer->create(array(
                    //"name" => $newcustomer['name'],
                    "email" => $newcustomer['email'],
                    "contact"=> $newcustomer['phone_number'],
                  )
                );
                $newcustomer->razorpay_customer_id = $customer->id;
                $newcustomer->save();
            }
            catch (BadRequestError $e) 
            {
                dd($e->getMessage());
            }
        }
        elseif($data['payment_type'] == 1)
        {
            try 
            {
                $customer  = $api->order->create([
                    'receipt' => 'NSN',
                    'amount'  => $amount,
                    'currency' => 'INR',
                    'payment_capture' => 0,
                ]);
                $newcustomer->razorpay_order_id = $customer['id'];
                $newcustomer->save();
            }
            catch (BadRequestError $e) 
            {
                dd($e->getMessage());
            }
        }
        return $newcustomer;
    }

    const TYPE_BOOKING_FORM = 1;
    const TYPE_CONTACT_FORM = 2;
    const TYPE_AFFILIATE = 3;
    const TYPE_BANNER = 4;

    const STATUS_DEACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_PENDING = 2;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function place()
    {
        return $this->hasOne(Place::class, 'id', 'place_id');
    }


}