<?php
namespace App\Http\Controllers\Partner;
use App\Models\Booking;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PartnerWallet;
use Razorpay\Api\Api;
use Session;
use Redirect;
use auth;

class RazorpayController extends Controller
{
    
  

 public function payWithRazorpays(Request $request)
    {
        

          
          return view('partner.order_payment_Razorpay');
        
    }
    
     public function payWithRazorpayss(Request $request)
    {
        

          
          return view('partner.order_payment_Razorpays');
        
    }

   public function payments(Request $request)
    {        
        
        if($request->amount)
        {
                 $order = new PartnerWallet;
                 $order->name = $request->remark;
                 $order->user_id = Auth::user()->id;
                 $order->type = 'credit';;
                 $order->category = 'Wallet Balance';
                 $order->amount =  $request->amount;
            $order->save();
        
         return redirect('/partnercp/partner-wallet')->with('success', ' Added balance successfully  in your wallet!');
        }
        else{
       $order = User::findOrFail(Auth::user()->id);
            $order->payment_status = '1';
            // $order->payment_id = $razorpay_payment_id;
            $order->save();
        
         return redirect('/partnercp/')->with('success', 'Thanks for your Buying premium membership from Nsn hotels!');
        }
        }
       
    
    

    //redirects to this method after a successfull checkout
    public function checkout_done($order_id, $razorpay_payment_id)
    {
       
            $order = User::findOrFail(Auth::user()->id);
            $order->payment_status = '1';
            // $order->payment_id = $razorpay_payment_id;
            $order->save();
        
         return redirect('/partnercp/')->with('success', 'Thanks for your Buying premium membership from Nsn hotels!');

    
    }
}