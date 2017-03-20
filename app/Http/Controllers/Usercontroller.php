<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
//Sử dụng thư viện Auth
use Illuminate\Support\Facades\Auth;

class Usercontroller extends Controller
{
    //Hien thi danh sach user
    public function getDanhSach(){
    	$user=User::all();
    	return view('admin/user/danhsach',['user'=>$user]);
      //Kiem tra nguoi dung da dang nhap hay chua neu dang nhap roi thi truyen len bien nguoi dung view()-share
      
        
    }

    //Them user
    public function getThem(){
    	return view('admin/user/them');
    }



    public function postThem(Request $request){
    	$this->validate($request,
    		[
    			'name'=>'required|min:3',
   /* 			Email khong duoc de trong ,dung dinh dang email va email khong duoc trung voi cot email trong csdl*/
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
    	$user->quyen=$request->quyen;

    	$user->save();
    	return redirect('admin/user/them')->with('thongbao','Bạn đã thêm user thành công!');
    }

    //Phan sua cho user
   public function getSua($id){
   		$user=User::find($id);
   		return view('admin/user/sua',['user'=>$user]);
   }
   //Sửa post
   public function postSua(Request $request,$id){
          $this->validate($request,
        [
          'name'=>'required|min:3',
   /*       Email khong duoc de trong ,dung dinh dang email va email khong duoc trung voi cot email trong csdl*/
          
         

        ],
        [
          'name.required'=>'Bạn chưa nhập tên đầy đủ!',
          'name.min'=>'Tên người dùng phải có ít nhất 3 kí tự',
          
        
        ]);
    
      $user=User::find($id);
      $user->name=$request->name;
      //$user->email=$request->email;
    
      $user->quyen=$request->quyen;
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
      return redirect('admin/user/sua/'.$id)->with('thongbao','Bạn đã sửa user thành công!');
    }




     //Phan xoa cho user
     public function getXoa($id){
     	$user=User::find($id);
     	$user->delete();
     	return redirect('admin/user/danhsach')->with('xoa','Ban da xoa thanh cong');
     }


     //
     public function getDangNhapAdmin(){
      return view('admin.login');

     }

     public function postDangNhapAdmin(Request $request){
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
      //Dùng Hàm Auth để kiếm tra đăng nhập
      if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
          return redirect('admin/theloai/danhsach');
        }
        else
        {
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập thất bại hí hí ');
        }

     }

     public function getDangXuatAdmin()
     {
        //log out
        Auth::logout();
        return redirect('admin/dangnhap');

     }
}
