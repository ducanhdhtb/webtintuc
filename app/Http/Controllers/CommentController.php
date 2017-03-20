<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
     function postComment($id,Request $request)
    {
    	$idTinTuc=$id;
    	$tintuc=TinTuc::find($id);
    	$comment=new Comment;
    	$comment->idTinTuc=$idTinTuc;
    	$comment->idUser=Auth::user()->id;
    	$comment->NoiDung=$request->NoiDung;

    	$comment->save();
    	return redirect("tintuc/$id/".$tintuc->TieuDeKhongDau.".html")->with('thongbao','Done!');
    }
}
