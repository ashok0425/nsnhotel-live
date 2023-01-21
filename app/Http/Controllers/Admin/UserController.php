<?php

namespace App\Http\Controllers\Admin;

use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Astrotomic\Translatable\Validation\RuleFactory;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class UserController extends Controller
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function list(Request $request,$id=null)
    {
   
    if($request->ajax()){
       
        $users = User::query()
            ->orderBy('id', 'desc');

            if ($request->keyword) {
                $users=$users->where('name','LIKE',"%$request->keyword%")->orwhere('phone_number','LIKE',"%$request->keyword%")->orwhere('email','LIKE',"%$request->keyword%");   
                }
        
                if ($request->from && $request->to) {
                  $users=$users->whereBetween('created_at',[$request->from,$request->to]);
                  }

                  if ($request->role) {
                    if ($request->role==1) {
                        $users=$users->where('is_partner','!=',1)->where('is_agent','!=',1);
                    }
                    if ($request->role==2) {
                        $users=$users->where('is_partner',1);
                    }

                    if ($request->role==3) {
                        $users=$users->where('is_agent',1);
                    }
                    }
                    return FacadesDataTables::of($users)
                 
                    ->editColumn('status',function($row){
                        $html='<input type="checkbox" class="js-switch user_status" data-id="'.$row->id.'"'.isChecked($row->status, \App\Models\User::STATUS_ACTIVE).'>';
                        return $html;
                      })
                      ->editColumn('avatar',function($row){
                        $html='<img src="'.getImageUrl($row->avatar).'" width="100"/>';
                        return $html;
                      })
                      ->addColumn('is_admin',function($row){
                        $html='<input type="checkbox" class="js-switch user_admin" data-id="'.$row->id.'"'.isChecked($row->is_admin, \App\Models\User::USER_ADMIN).'>';
                        return $html;
                      })
                      ->addColumn('is_partner',function($row){
                        $html='<input type="checkbox" class="js-switch user_admin" data-id="'.$row->id.'"'.isChecked($row->is_partner, \App\Models\User::USER_PARTNER).'>';
                        return $html;
                      })
                      ->editColumn('created_at',function($row){
                        $html=formatDate($row->created_at, 'H:i d/m/Y');
                        return $html;
                      })

                      ->editColumn('action',function($row){
                        $html='<form class="d-inline" action="'.route('admin_user_delete',$row->id).'" method="GET">
                        <button type="button" class="btn btn-danger btn-xs user_delete">Delete</button>
                   </form>
                   <button type="button" class="btn btn-xs btn-primary " 
                   data-name="'.$row->name.'"
                   data-email="'.$row->email.'"
                   data-id="'.$row->id.'"

                   data-phone_number="'.$row->phone_number.'"
                 

                   id="edit_btn" data-scr="'.getImageUrl($row->avatar).'">Edit</button>';
                   return $html;
                      })
                    ->rawColumns(['status','action','is_admin','is_partner','avatar'])
                    ->make(true);
      
    }
    
    if($id==1){
        $users = User::join('visitors','visitors.id','users.ip_id')->whereYear('visitors.updated_at',carbon::now()->year)->whereMonth('visitors.updated_at',carbon::now()->month)->whereBetween('visitors.updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('visitors.updated_at', 'desc')
           
            ->paginate(15);
            return view('admin.user.user_list', [
                'users' => $users
            ]);
    }

    // dd($users);
    return view('admin.user.user_list');
        
    }

    public function store(Request $request)
    {
        
        $rule_factory = RuleFactory::make([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required',
            'password' => '',
            'is_partner' => '',

        ]);
        $ispartner = 0;
         $isagent = 0;
        if($request->role == "partner"){
            $ispartner = 1;
        }
        elseif($request->role == "agent"){
            $isagent = 1;
        }
        $data = $this->validate($request, $rule_factory);
        $model = new User();
        $model->name = $data['name'];
        $model->email = $data['email'];
        $model->phone_number = $data['phone'];
        $model->password = Hash::make($data['password']);
        $model->is_partner = $ispartner;
        $model->is_agent = $isagent;
        $model->save();
        return back()->with('success', 'Add user success!');
    }

    public function loginPage()
    {
        if (Auth::check())
            return redirect(route('admin_dashboard'));

        return view('admin.user.admin_login');
    }
    
    
    public function updateStatus(Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);

        $model = User::find($request->user_id);
        $model->fill($data);

        if ($model->save()) {
            return $this->response->formatResponse(200, $model, 'Update user status success!');
        }
    }

    public function updateRoleAdmin(Request $request)
    {
        $data = $this->validate($request, [
            'is_admin' => 'required',
        ]);

        $model = User::find($request->user_id);
        $model->fill($data);

        if ($model->save()) {
            return $this->response->formatResponse(200, $model, 'Update role admin success!');
        }
    }


    public function updateRolePartner(Request $request)
    {
        $data = $this->validate($request, [
            'is_partner' => 'required',
        ]);

        $model = User::find($request->user_id);
        $model->fill($data);

        if ($model->save()) {
            return $this->response->formatResponse(200, $model, 'Update role partner success!');
        }
    }
    
     public function storeUser(Request $request)
    {
        $rule_factory = RuleFactory::make([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => '',
            'password' => 'required',
            'is_partner' => '',

        ]);
 $ispartner = 0;
         $isagent = 0;
        if($request->role == "partner"){
            $ispartner = 1;
        }
        elseif($request->role == "agent"){
            $isagent = 1;
        }
        $data = $this->validate($request, $rule_factory);

        $model = new User();
        $model->name = $request->name;
        $model->email = $request->email;
        $model->phone_number = $request->phone_number;
        $model->password = Hash::make($request->password);
         $model->is_partner = $ispartner;
        $model->is_agent = $isagent;
        $model->save();

        return back()->with('success', 'Add user success!');
    }
    
       public function destroy(Request $request, $id)
        {
            User::destroy($id);
            return back()->with('success', 'Delete User success!');
        }
            public function sms(Request $request)
        {
             return view('admin.user.sms');
        }
        
        public function bq_list(Request $request,$id=null)
    {
    $users = DB::table('Banquet_Leads')->orderBy('id', 'desc')->get();
// echo $users;
        return view('admin.user.user_bq_list', [
            'users' => $users
        ]);
    }



    public function updateuser(Request $request)
    {
        $rule_factory = RuleFactory::make([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255',

        ]);
 $ispartner = 0;
         $isagent = 0;
        if($request->role == "partner"){
            $ispartner = 1;
        }
        elseif($request->role == "agent"){
            $isagent = 1;
        }
        $data = $this->validate($request, $rule_factory);
        $model =  User::find($request->users_id);
        $model->name = $request->name;
        $model->email = $request->email;
        $model->phone_number = $request->phone_number;
        if ($request->password && $request->password!=null) {
            $model->password = Hash::make($request->password);
        }
        if ($request->hasFile('avatar')) {
            $icon = $request->file('avatar');
            $file_name = $this->uploadImage($icon, '');
            $model->avatar = $file_name;
        }
         $model->is_partner = $ispartner;
        $model->is_agent = $isagent;
        $model->save();

        return back()->with('success', ' user update success!');
    }
}