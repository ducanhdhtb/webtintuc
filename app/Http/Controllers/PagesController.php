<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theloai;
use App\Slide;
use App\loaiTin;
use App\TinTuc;
use App\User;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    function __construct()
    {
    	$theloai=TheLoai::all();
    	$slide=Slide::all();
    	view()->share('theloai',$theloai);
    	view()->share('slide',$slide);
    
    	view()->composer('*', function($view) {
            $view->with('nguoidung', auth()->user());
        });
    	
    /*	if(Auth::check())
    	{
            $user=Auth::user();
    		view()->share('nguoidung',$user);
     
    	}
    */

   
    }
    function trangchu()
    {
    	//$theloai=TheLoai::all();
    	return view('pages.trangchu');//->with('theloai',$theloai);
    }

    function lienhe()
    {
    	//$theloai=TheLoai::all();
    	return view('pages.lienhe');//->with('theloai',$theloai);
    }

    //Dành cho loại tin nhé
      function loaitin($id)
    {
    	//$theloai=TheLoai::all();
    	$loaitin=LoaiTin::find($id);
    	$tintuc=TinTuc::where('idLoaiTin',$id)->paginate(5);
    	return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);//->with('theloai',$theloai);
    }

    // Dành cho tin tức nhé okk
    function tintuc($id){

    	$tintuc=TinTuc::find($id);
    	$tinnoibat=TinTuc::where('NoiBat',1)->take(4)->get();
    	$tinlienquan=TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
    	return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }
    //Dành cho đăng nhập
    function getDangNhap()
    {	
    	return view('pages.dangnhap');
    }

     function postDangNhap(Request $request)
    {	
    	$this->validate($request,
        [
          'email'=>'required',
          'password'=>'required|min:6|max:32'

        ],
        [
          'email.required'=>'Email trống kìa đồ ngu!',
          'password.required'=>'Không nhìn thấy mật khẩu trống à ! :))',
          'password.min'=>'Password phải trên 3 kí tự ! :))',
          'password.max'=>'Password phải dưới 32 kí tự ! :))',
        ]);
     //Kiem tra dang nhap
    	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
          return redirect('trangchu');
        }
        else
        {
            return redirect('dangnhap')->with('thongbao','Đăng nhập thất bại hí hí ');
        }

     
    }
    //dang xuat
    function getDangXuat()
    {
    	Auth::logout();
          return redirect('trangchu');
    }
    //Nguoi dung
    function getNguoidung()
    {
        $user=Auth::user();
        return view('pages.nguoidung',['nguoidung'=>$user]);

    }

    //post nguoi dung
    function postNguoidung(Request $request)
    {
          $this->validate($request,
        [
          'name'=>'required|min:3',
   /*       Email khong duoc de trong ,dung dinh dang email va email khong duoc trung voi cot email trong csdl*/
        ],
        [
          'name.required'=>'Bạn chưa nhập tên đầy đủ!',
          'name.min'=>'Tên người dùng phải có ít nhất 3 kí tự',
          
        
        ]);
    
              $user=Auth::user();
              $user->name=$request->name;
             //$user->email=$request->email;
    
          
        if($request->changePassword=="on")
        {
            //----------------------
                        $this->validate($request,
                  [
                   
               
                    'password'=>'required|min:3|max:32',
                    'passwordAgain'=>'required|same:password',

                  ],
                  [
                    
                    'password.required'=>'Mật khẩu không được để trống',
                    'password.min'=>'Mật khẩu tối thiểu 3 kí tự',
                    'password.max'=>'Mật khẩu tối đa 32 kí tự',
                    'passwordAgain.required'=>'Mật khẩu không được để trống',
                    'passwordAgain.same'=>'Mật khẩu phải trùng nhau',
                  ]);
              //----------------------
              $user->password=bcrypt($request->password);

        }

      $user->save();
      return redirect('nguoidung')->with('thongbao','Bạn đã sửa user thành công!');
    }

    function getDangki()
    {
        return view('pages.dangki');
    }
     function postDangki(Request $request)
    {
            $this->validate($request,
            [
                'name'=>'required|min:3',
   /*           Email khong duoc de trong ,dung dinh dang email va email khong duoc trung voi cot email trong csdl*/
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:3|max:32',
                'passwordAgain'=>'required|same:password',

            ],
            [
                'name.required'=>'Bạn chưa nhập tên đầy đủ!',
                'name.min'=>'Tên người dùng phải có ít nhất 3 kí tự',
                'email.required'=>'Bạn chưa nhập  email',
                'email.email'=>'Email không đúng định  dạng',
                'email.unique'=>'Email đã tồn tại!',
                'password.required'=>'Mật khẩu không được để trống',
                'password.min'=>'Mật khẩu tối thiểu 3 kí tự',
                'password.max'=>'Mật khẩu tối đa 32 kí tự',
                'passwordAgain.required'=>'Mật khẩu không được để trống',
                'passwordAgain.same'=>'Mật khẩu phải trùng nhau',
            ]);
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->quyen=0;

        $user->save();
        return redirect('dangki')->with('thongbao','Chúc mừng ạn đã đăng kí thành công!');
    }

    //Tim kiem
    function timkiem(Request $request)
    {
        $tukhoa=$request->tukhoa;
        $tintuc=TinTuc::where('TieuDe','Like',"%$tukhoa%")->orwhere('TomTat','Like',"%$tukhoa%")->orwhere('NoiDung','Like',"%$tukhoa%")->take(30)->paginate(5);
        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }

    
}
