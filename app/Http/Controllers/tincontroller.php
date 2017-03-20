<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tin;

class tincontroller extends Controller
{
    //
    public function index(){
    	//$tin= Tin::paginate(2);
    	//$tin=array("hai","tuan");
    	return view('tin',['tin'=>'$tin']);
    	

    }
}
