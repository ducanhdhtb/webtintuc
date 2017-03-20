 @extends('admin.layout.index')
 @section('content')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                       <!-- Hien thi thong bao loi -->
                        @if(count('$errors')>0 )
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>

                                @endforeach
                             </div>
                       
                        @endif
                     <!--    Kiem tra xem co ton tai thong bao khong -->
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                         @if(session('loi'))
                            <div class="alert alert-success">
                                {{session('loi')}}
                            </div>
                        @endif
                        <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <!-- Danh cho the loai -->
                            <div class="form-group">
                                <label>The loai</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                                </select>
                            </div>
                        <!-- Danh cho loai tin -->
                      
                        <div class="form-group">
                                <label>Loai tin</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                    @foreach($loaitin as $lt)
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                                </select>
                            </div>
                        <!-- end danh cho loaitin -->
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Vui lòng nhập tiêu đề" />
                            </div>
                         <!--  Tom tat -->
                            <div class="form-group">
                                <label>Tóm Tắt</label>
                                <textarea name="TomTat" id="demo" class="form-control ckeditor" rows="3"></textarea>
                            </div>
                          <!--   Noi dung -->
                          <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="3"></textarea>
                            </div>
                        <!--     END NOI DUNG -->
                      <!--   Phan hinh anh -->
                      <div class="form-group">
                          <label>Hình</label>
                          <input type="file" name="Hinh">
                      </div>
                      <!--   End Phan hinh anh -->
                            <div class="form-group">
                                <label>NoiBat</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" checked="" type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" type="radio">Có
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        @endsection

        @section('script')
        <script >
            $(document).ready(function(){
                $('#TheLoai').change(function(){
                    var idTheLoai=$(this).val();
                    //alert(idTheLoai);
                    $.get("admin/ajax/loaitin/"+idTheLoai,function(data){

                        $("#LoaiTin").html(data);
                        //alert(data);
                    });
                  
                });
            });
        </script>
        @endsection