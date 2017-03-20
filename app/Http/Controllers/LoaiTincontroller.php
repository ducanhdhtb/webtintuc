<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;

class LoaiTinController extends Controller
{
    //
    public function getDanhsach()
    {
       	$loaitin=LoaiTin::all();
    	return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }

    public function getThem()
    {
        $theloai=TheLoai::all();
    	return view('admin.loaitin.them',['theloai'=>$theloai]);
    }

    //--------Phuong thuc post them
    public function postThem(Request $request)
    {
       $this->validate($request,
        [
            'Ten'=>'required|unique:LoaiTin,Ten|min:1|max:20',
            'TheLoai'=>'required'
        ],
        [
            'Ten.required'=>'Bạn không được để trống trường nội dung này',
            'Ten.unique'=>'Loại tin này đã tồn tại!',
            'Ten.min'=>'Gia tri nhap vao phai lon hon 1 ki tu',
            'Ten.max'=>'Gia tri nhap vao phai nhỏ hon 20 ki tu',
            'TheLoai.required'=>'Bạn vui lòng lựa chọn thể loại nhé hehe!'
        ]);
       $loaitin=new LoaiTin;
       //Gán giá trị nhận được cho cột tên
       $loaitin->Ten=$request->Ten;
        $loaitin->TenKhongDau=changeTitle($request->Ten);
       $loaitin->idTheLoai=$request->TheLoai;
       $loaitin->save();
       return redirect('admin/loaitin/them')->with('thongbao','Ban da them thanh cong loai tin ! hehe');
    }


    public function getSua($id)
    {
        $theloai=TheLoai::all();
    	$loaitin=LoaiTin::find($id);
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }


    //Function sua
    public function postSua(Request $request,$id)
    {
       $loaitin=LoaiTin::find($id);
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
       $loaitin=LoaiTin::find($id);
       $loaitin->Ten=$request->Ten;
       $loaitin->TenKhongDau=changeTitle($request->Ten);
       $loaitin->idTheLoai=$request->TheLoai;
       $loaitin->save();
       return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Bạn đã sửa thành công loại tin');
    }

    //function xoa
    public function getXoa($id){
     
    }

}
