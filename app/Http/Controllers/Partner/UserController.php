<?php

namespace App\Http\Controllers\Partner;

use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function loginPage()
    {
        if (Auth::check())
            return redirect(route('partner_dashboard'));

        return view('partner.user.partner_login');
    }

}