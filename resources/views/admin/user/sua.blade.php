 @extends('admin.layout.index')
 @section('content')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>{{$user->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                     <!-- Hien thi thong bao loi -->
                        @if(count('$errors')>0 )
                          
                                @foreach($errors->all() as $err)
                                  <span class="alert alert-danger">
                                    {{$err}}<br>
                                    </span>  
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
                        <form action="admin/user/sua/{{$user->id}}" method="POST">
                         <input type="hidden" name="_token" value="{{csrf_token()}}">
                         <!--   Tên -->
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input class="form-control" name="name" placeholder="Nhập tên người dùng" value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" readonly="" placeholder="Vui lòng nhập email của bạn" value="{{$user->email}}" />
                            </div>
                        <!--     Mật khẩu -->
                            <div class="form-group">
                                <p><input type="checkbox" id="changePassword" name="changePassword"></p>
                                <label>Đổi Mật khẩu</label>
                                <input type="password" class="form-control password" name="password" placeholder="Vui lòng nhập mật khẩu" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại Mật khẩu</label>
                                <input type="password" class="form-control password" name="passwordAgain" placeholder="Vui lòng nhập lại mật khẩu" disabled="" />
                            </div>
                         <!--    Phân quyền người dùng -->
                            <div class="form-group">
                                <label>Phân quyền</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0"
                                    @if($user->quyen==0)
                                    {{"checked"}}
                                    @endif
                                     type="radio">Tk Thường
                                  
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" 
                                    @if($user->quyen==1)
                                    {{"checked"}}
                                    @endif
                                    value="1" type="radio">Admin
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới tài khoản</button>
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
                    //Bắt sự kiện khi người dùng thay đổi nút change
                    $("#changePassword").change(function(){
                        //Neus người dùng click vào nút check
                        if($(this).is(":checked"))
                            {
                                $(".password").removeAttr('disabled');
                            }
                        else
                            {
                                $(".password").attr('disabled','');
                            }
                    });
                });
            </script>
        @endsection