 @extends('admin.layout.index')
 @section('content')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                       <!-- Hien thi thong bao loi -->
                        @if(count('$errors')>0 )
                         
                                @foreach($errors->all() as $err)
                                   <div class="alert alert-danger">
                                    {{$err}}<br>
                                    </div>
                                @endforeach
                             
                       
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
                        <form action="admin/slide/them" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <!-- Danh cho the loai -->
                           
                        <!-- Danh cho loai tin -->
                      
                        <!-- end danh cho loaitin -->
                            <div class="form-group">
                                <label>Tên Slide</label>
                                <input class="form-control" name="Ten" placeholder="slide..." />
                            </div>
                         <!--  Tom tat -->
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="NoiDung" id="NoiDung" class="form-control ckeditor" rows="3"></textarea>
                            </div>
                          <!--   Noi dung -->
                          <div class="form-group">
                                <label> Nhập Link</label>
                                <input class="form-control" name="link" placeholder="Link..." />
                            </div>
                        <!--     END NOI DUNG -->
                      <!--   Phan hinh anh -->
                      <div class="form-group">
                          <label>Hình</label>
                          <input type="file" name="Hinh">
                      </div>
                      <!--   End Phan hinh anh -->
                           
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