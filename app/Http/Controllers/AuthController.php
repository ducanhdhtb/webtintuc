<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class AuthController extends Controller
{
    //
     //
    public function login(Request $request)
    {
    	//echo $request['username']."<br>";
    	//echo $request['password'];
    	$username=$request['username'];
    	$password=$request['password'];
    	if(Auth::attempt(['name'=> $username,'password'=>$password]))
        {
    		return view('thanhcong',['user'=>Auth::user()] );
            //Tra ve view thanh cong kem theo thong tin ma nguoi dung da dang nhap
        }

    	else
        {
    		return view('dangnhap',['error'=>'Dang nhap that bai!']);
        }

    }

    //Logout
    public function logout(){
        Auth::logout();
        return view('dangnhap');
    }
}
