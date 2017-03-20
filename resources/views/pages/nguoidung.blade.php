@extends('layout.index');
@section('content')
   <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Thông tin tài khoản</div>
				  	<div class="panel-body">
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
				    	<form action="nguoidung" method="post">
				    	 <input type="hidden" name="_token" value="{{csrf_token()}}">
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" class="form-control" placeholder="" value="{{$nguoidung->name}}" name="name" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="{{$nguoidung->email}}" name="email" aria-describedby="basic-addon1"
							  	disabled
							  	>
							</div>
							<br>	
							<div>
								<input type="checkbox" class="" name="changePassword" id="changePassword">
				    			<label>Đổi mật khẩu</label>
							  	<input type="password" class="form-control password" name="password" aria-describedby="basic-addon1" disabled="">
							</div>
							<br>
							<div>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" class="form-control password" name="passwordAgain" aria-describedby="basic-addon1" disabled="">
							</div>
							<br>
							<button type="sua" class="btn btn-default">Sửa
							</button>

				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
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