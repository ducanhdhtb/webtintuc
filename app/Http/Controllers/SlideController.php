<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    //
    public function getDanhsach()
    {
      $slide=Slide::all();
      return view('admin/slide/danhsach')->with('slide',$slide);
    

    }

    public function getThem()
    {
     
      return view('admin.slide.them');
    }

    //--------Phuong thuc post them
    public function postThem(Request $request)
    {
        //Validate nhé cưng!
        $this->validate($request,
          [
            'Ten'=>'required',
            'NoiDung'=>'required',
            //'link'=>'required',
          ],
          [
            'Ten.required'=>'Vui lòng nhập tên cho slide nhé hehe!',
            'NoiDung.required'=>'Vui lòng nhập nội dung nhé Đồ Ngốc!',
            //'link.required'=>'Nhập link nhé đồ ngu!',
          ]);
        //
        $slide=new Slide;
        $slide->Ten=$request->Ten;
        //$slide->Hinh=$request->Hinh;
        $slide->NoiDung=$request->NoiDung;
        if($request->has('link')){
           $slide->link=$request->link;
        }
        if($request->hasFile('Hinh'))
                {
                  //Lấy cái hình ra,Lưu hình vào cái biens file này
                  $file=$request->file('Hinh');
                  $duoi=$file->getClientOriginalExtension();
                  if($duoi !='jpg' && $duoi !='png' && $duoi!='jpeg')
                  {
                     return redirect("admin/slide/them")->with('loi','Bạn chỉ được phép chọn ảnh!');
                  }
                  //Láy cái tên hình ra để lưu lại
                  $name=$file->getClientOriginalName();
                  //Random trong trường hợp tấm hình trùng
                  $Hinh=str_random(4)."_".$name;
                  while(file_exists("upload/slide/".$Hinh))
                  {
                    $Hinh=str_random(4)."_".$name;
                  }
                  //Chọn đường dẫn lưu hình
                  $file->move("upload/slide",$Hinh);
                  $slide->Hinh=$Hinh;
              }
          else
          {
            $slide->Hinh="";
          }
       // Save it 
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Bạn đã thêm slide thành công!');

    }
//End them-------------------------------------------------------------

    public function getSua($id)
    {
      $slide=Slide::find($id);
      return view('admin.slide.sua')->with('slide',$slide);
    }

    //Function sua
    public function postSua(Request $request,$id)
    {
       $this->validate($request,
          [
            'Ten'=>'required',
            'NoiDung'=>'required',
            //'link'=>'required',
          ],
          [
            'Ten.required'=>'Vui lòng nhập tên cho slide nhé hehe!',
            'NoiDung.required'=>'Vui lòng nhập nội dung nhé Đồ Ngốc!',
            //'link.required'=>'Nhập link nhé đồ ngu!',
          ]);
        //
        $slide=Slide::find($id);
        $slide->Ten=$request->Ten;
        //$slide->Hinh=$request->Hinh;
        $slide->NoiDung=$request->NoiDung;
        if($request->has('link')){
           $slide->link=$request->link;
        }
        if($request->hasFile('Hinh'))
                {
                  //Lấy cái hình ra,Lưu hình vào cái biens file này
                  $file=$request->file('Hinh');
                  //Cái này dùng để lấy đuôi của file ảnh
                  $duoi=$file->getClientOriginalExtension();
                  //Kiếm tra định dang file ảnh
                  if($duoi !='jpg' && $duoi !='png' && $duoi!='jpeg')
                      {
                         return redirect("admin/slide/sua")->with('loi','Bạn chỉ được phép chọn ảnh!');
                      }
                  //Láy cái tên hình ra để lưu lại
                  $name=$file->getClientOriginalName();
                  //Random trong trường hợp tấm hình trùng
                  $Hinh=str_random(4)."_".$name;
                  while(file_exists("upload/slide/".$Hinh))
                  {
                    $Hinh=str_random(4)."_".$name;
                  }
                  //unlink cái hình cũ đi
                 // unlink("upload/slide/".$slide->Hinh);
                  //Chọn đường dẫn lưu hình
                  $file->move("upload/slide/",$Hinh);
                  $slide->Hinh=$Hinh;
              }
       
       // Save it 
        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao','Bạn đã sửa thành công nhé !!');
              
    }
     


      


    //function xoa
    public function getXoa($id)
    {
       $slide=Slide::find($id);
       $slide->delete();
       return redirect('admin/slide/danhsach')->with('thongbao','Xóa ok nhé ! ');
    }

}
