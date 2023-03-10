<?php
namespace App\Http\Controllers\Auth;

use App\Commons\APICode;
use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\ReferPrice;
use App\Models\ReferelMoney;

use Illuminate\Support\Str;


class RegisterController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $user;
    protected $response;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Response $response)
    {
        $this->middleware('guest');
        $this->user = $user;
        $this->response = $response;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function register(Request $request)
    {
         $data = $request->segment(2); 
         
        $validator = $this->user->validateRegister($request);

        if ($validator->code == APICode::SUCCESS) {
            $user = $this->user->create($request);
            if($request->referral_code){
                  $refer = str_replace("NSN","",$request->referral_code);
                $referl_price = ReferPrice::first();
                $referl_money = new ReferelMoney();
                $referl_money->user_id = $refer;
                $referl_money->price =  $referl_price->share_price; 
                $referl_money->refewrel_type ='2' ;
                $referl_money->referel_code =$request->referral_code ;
                $referl_money->save();
                $join_money = new ReferelMoney();
                $join_money->user_id = $user->id;
                $join_money->price =  $referl_price->join_price; 
                $join_money->refewrel_type ='1' ;
                $join_money->referel_code =$request->referral_code;
                $join_money->save();
             }
            $this->guard()->login($user);
        }
        
         return $this->response->formatResponse($validator->code, null, $validator->message);
         
    }

}
