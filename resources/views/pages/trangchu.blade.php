
@extends('layout.index')
@section('content')
<div class="container">

    	<!-- slider -->
    	@include('layout.slide');
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            @include('layout.menu')


            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
	            	
	            		@foreach($theloai as $tl)
	            		@if(count($tl->loaitin)>0)
					    <div class="row-item row">
		                	<h3>
		                		<a href="#">{{$tl->Ten}}</a> | 
		                		<?php 
		                			$tlis=$tl->loaitin->take(5);
		                		 ?>
		                		@foreach($tlis as $lt)	
		                		<small><a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html"><i>{{$lt->Ten}}</i></a>/</small>
		                		@endforeach
		                		
		                	</h3>
		                	<?php
		                /*	$data là một mảng nhé*/
		                	$data=$tl->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(5);
		                	/*hàm shift sẽ lấy ra 1 tin như vậy ở trong data sẽ còn 4 tin*/
		                	$tin1=$data->shift();
		                	//Hàm shift sau khi lấy dữ liệu xong sẽ trả về kiểu mảng4
		                	?>
		                	<div class="col-md-8 border-right">
		                		<div class="col-md-5">
			                        <a href="detail.html">
			                            <img class="img-responsive" src="upload/tintuc/{{$tin1['Hinh']}}" alt="">
			                        </a>
			                    </div>

			                    <div class="col-md-7">
			                        <h3>{{$tin1['TieuDe']}}</h3>
			                        <p>{{$tin1['TomTat']}}</p>
			                        <a class="btn btn-primary" href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">Xem Thêm <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>

		                	</div>
		                    

							<div class="col-md-4">
							@foreach($data->all() as $tintuc)
								<a href="tintuc/{{$tintuc['id']}}/{{$tintuc['TieuDeKhongDau']}}.html">
									<h4 style="font-size:15px">
										<span  class="glyphicon glyphicon-list-alt"></span>
										{{$tintuc['TieuDe']}}
									</h4>
								</a>
								@endforeach
							</div>
							
							<div class="break"></div>
		                </div>
		                @endif
		                @endforeach
		                <!-- end item -->
		                <!-- item -->

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
@endsection