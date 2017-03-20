<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//Sử dụng thư viện Auth
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   function __construct()
    {
    	$this->DangNhap();
    }

    function DangNhap(){
    	//Kiem tra dang nhap hay chua bang Auth
    	/*if(Auth::check())
	    	{
	    		view()->share('user_login',Auth::user());
	    	}*/
            view()->composer('*', function($view) {
            $view->with('user_login', auth()->user());
        });
    }
}
