<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getDanhsach()
    {
       	$theloai=TheLoai::all();
    	//return view('admin.theloai.danhsach',['theloai'=>$theloai]);
        return view('admin.theloai.danhsach')->with('theloai',$theloai);
    }

    public function getThem()
    {
    	return view('admin.theloai.them');
    }

    //--------Phuong thuc post them
    public function postThem(Request $request)
    {
        //echo $request->Ten;
        $this->validate($request,
            [
                'Ten'=> 'required|min:3|max:100|unique:TheLoai,Ten'
            ],
            [
                'Ten.required'=>'Ban chua nhap ten the loai',
                'Ten.min'=>'Ten the loai phai tu 3 den 100 ki tu',
                'Ten.max'=>'Ten the loai phai tu 3 den 100 ki tu',
                'Ten.unique'=>'Ten the loai da ton tai',

            ]);
           $theloai=new TheLoai;
        $theloai->Ten=$request->Ten;
        $theloai->TenKhongDau=changeTitle($request->Ten);
        //echo changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Add successful!');
    }


    public function getSua($id)
    {
    	$theloai=TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }


    //Function sua
    public function postSua(Request $request,$id)
    {
       $theloai=TheLoai::find($id);
       $this->validate($request,
        //Mang check looix
        [
            'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
        ],
        //Mang hien thi loi
        [
            'Ten.required'=>'Ban chua nhap ten',
            'Ten.unique'=>'Ten the loai da ton tai',
            'Ten.min'=>'Ten phai tren 3 ki tu va duoi 100 ki tu',
            'Ten.max'=>'Ten phai tren 3 ki tu va duoi 100 ki tu',
        ]
        );
       $theloai->Ten=$request->Ten;
       $theloai->TenKhongDau=changeTitle($request->Ten);
       $theloai->save();
       return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sua thanh cong');
    }

    //function xoa
    public function getXoa($id){
        $theloai=TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','Delete complete!');

    }

}
