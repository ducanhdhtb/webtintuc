<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;

class TinTucController extends Controller
{
    //
    public function getDanhsach()
    {
      
     $tintuc=TinTuc::orderBy('id','DESC')->get();
     return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);

    }

    public function getThem()
    {
      $theloai=TheLoai::all();
      $loaitin=LoaiTin::all();
     return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);

    }

    //--------Phuong thuc post them
    public function postThem(Request $request)
    {
          $this->validate($request,
            [
              'LoaiTin'=>'required',
              'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
              'TomTat'=>'required',
              'NoiDung'=>'required',
            ],
            [
            'LoaiTin.required'=>'Bạn chưa chọn loại tin',
            'TieuDe.required'=>'Bạn chưa chọn tiêu đề',
            'TieuDe.min'=>'Tên tiêu đề phải trên 3 kí tự',
            'TieuDe.unique'=>'Tên tiêu đề không được trùng',
            'TomTat.required'=>' Tóm tắt không được để trống',
            'NoiDung.required'=>'Nội dung không được để trống',
            ]);
          //Khởi tạo đối tượng tin tức để lưu thông tin
          $tintuc=new TinTuc;
          $tintuc->TieuDe=$request->TieuDe;
          $tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
          $tintuc->idLoaiTin=$request->LoaiTin;
          $tintuc->TomTat=$request->TomTat;
          $tintuc->NoiDung=$request->NoiDung;
          $tintuc->SoLuotXem=0;
          //Kiem tra xem người dùng có lựa chọn hình ảnh hay không nếu không sẽ mặc định là rỗng
           if($request->hasFile('Hinh'))
                {
                  //Lấy cái hình ra,Lưu hình vào cái biens file này
                  $file=$request->file('Hinh');
                  $duoi=$file->getClientOriginalExtension();
                  if($duoi !='jpg' && $duoi !='png' && $duoi!='jpeg')
                  {
                     return redirect("admin/tintuc/them")->with('loi','Bạn chỉ được phép chọn ảnh!');
                  }
                  //Láy cái tên hình ra để lưu lại
                  $name=$file->getClientOriginalName();
                  //Random trong trường hợp tấm hình trùng
                  $Hinh=str_random(4)."_".$name;
                  while(file_exists("upload/tintuc/".$Hinh))
                  {
                    $Hinh=str_random(4)."_".$name;
                  }
                  //Chọn đường dẫn lưu hình
                  $file->move("upload/tintuc",$Hinh);
                  $tintuc->Hinh=$Hinh;
              }
          else
          {
            $tintuc->Hinh="";
          }


         $tintuc->save();
         return redirect("admin/tintuc/them")->with('thongbao','Nội  dung đã được thêm thành công!');


    }
//End them-------------------------------------------------------------

    public function getSua($id)
    {
      $theloai=TheLoai::all();
      $loaitin=LoaiTin::all();
    	$tintuc=TinTuc::find($id);
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }


    //Function sua
    public function postSua(Request $request,$id)
    {
     $tintuc=TinTuc::find($id);
      //Validate form
        $this->validate($request,
            [
              'LoaiTin'=>'required',
              'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
              'TomTat'=>'required',
              'NoiDung'=>'required',
            ],
            [
            'LoaiTin.required'=>'Bạn chưa chọn loại tin',
            'TieuDe.required'=>'Bạn chưa chọn tiêu đề',
            'TieuDe.min'=>'Tên tiêu đề phải trên 3 kí tự',
            'TieuDe.unique'=>'Tên tiêu đề không được trùng',
            'TomTat.required'=>' Tóm tắt không được để trống',
            'NoiDung.required'=>'Nội dung không được để trống',
            ]);
      //Them noi dung
          $tintuc->TieuDe=$request->TieuDe;
          $tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
          $tintuc->idLoaiTin=$request->LoaiTin;
          $tintuc->TomTat=$request->TomTat;
          $tintuc->NoiDung=$request->NoiDung;
     
          //Kiem tra xem người dùng có lựa chọn hình ảnh hay không nếu không sẽ mặc định là rỗng
           if($request->hasFile('Hinh'))
                {
                  //Lấy cái hình ra,Lưu hình vào cái biens file này
                  $file=$request->file('Hinh');
                  $duoi=$file->getClientOriginalExtension();
                  if($duoi !='jpg' && $duoi !='png' && $duoi!='jpeg')
                  {
                     return redirect("admin/tintuc/them")->with('loi','Bạn chỉ được phép chọn ảnh!');
                  }
                  //Láy cái tên hình ra để lưu lại
                  $name=$file->getClientOriginalName();
                  //Random trong trường hợp tấm hình trùng
                  $Hinh=str_random(4)."_".$name;
                  while(file_exists("upload/tintuc/".$Hinh))
                  {
                    $Hinh=str_random(4)."_".$name;
                  }
                  //Chọn đường dẫn lưu hình
                  $file->move("upload/tintuc",$Hinh);
                  unlink('upload/tintuc/'.$tintuc->Hinh);
                  $tintuc->Hinh=$Hinh;
              }
     


         $tintuc->save();
         return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Sửa thành công!');

      
    }

    //function xoa
    public function getXoa($id){
     $tintuc=Tintuc::find($id);
     $tintuc->delete();
     return redirect('admin/tintuc/danhsach');

    }

}
