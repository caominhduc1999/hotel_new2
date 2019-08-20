@include('header')
<div class="container">

    <h1 class="title">Luxirious Suites</h1>

    <!-- RoomDetails -->
    <div id="RoomDetails" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
                <div class="item active">
                    <img src="anhdaidien/{{$phong->anhdaidien}}" class="img-responsive" alt="slide1">
                </div>
            @foreach($anh as $key=>$value)
                <div class="item">                  {{--{{$key == 0 ? 'active' : '' }}--}}
                    <img src="images/{{$value->tenanh}}" class="img-responsive" alt="slide">
                </div>
            @endforeach
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#RoomDetails" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
        <a class="right carousel-control" href="#RoomDetails" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
    </div>
    <!-- RoomCarousel-->

    <div class="room-features spacer">
        <h2>{{$phong->tenphong}}</h2>
        <div class="row">
            <div class="col-sm-12 col-md-8" style="overflow: hidden">
                <p>{!! htmlspecialchars_decode($phong->thongtin) !!}</p>

                <!-- Blog Comments -->
                <br>
                <br>
                <br>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Your Comments here ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form" method="POST" action="{{action('CommentController@postComment')}}">
                        @csrf
                        <input type="hidden" name="id_phong" value="{{$phong->id}}">
                        @if(Auth::guard('khachhang')->check())
                            <input type="hidden" name="id_khachhang" value="{{Auth::guard('khachhang')->user()->id}}">
                        @endif
                        <div class="form-group">
                            <textarea class="form-control" name="noidung" rows="3"></textarea>
                        </div>
                        @if(Auth::guard('khachhang')->check())
                            <button type="submit" class="btn btn-primary">Send</button>
                        @else
                            <button type="submit" disabled="" class="btn btn-primary">Send</button>
                            <br>
                            <p href="" class="text text-danger">You need to <a href="customer/dangnhap" style="font-size: 1.2em; color: red; ">&nbsp;Login&nbsp;</a> to use this function</p>
                        @endif
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach($comment as $cm)
                <div class="media">
                    <a class="pull-left">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                        <div class="media-body">
                            <h4 class="media-heading">
                                @foreach($khachhang as $kh)
                                    @if($cm->id_khachhang == $kh->id)
                                        {{$kh->hoten}}
                                    @endif
                                @endforeach
                                <small>{{$cm->created_at}}</small>
                            </h4>
                            {{$cm->noidung}}
                        </div>
                </div>
                    <br>
                @endforeach
            </div>
            <br>
            {{--<div class="col-sm-6 col-md-3 amenitites">--}}
                {{--<h3>Amenitites</h3>--}}
                {{--<ul>--}}
                    {{--<li>One of the greatest barriers to making the sale is your prospect.</li>--}}
                    {{--<li>Principle to work to make more money while having more fun.</li>--}}
                    {{--<li>Unlucky people. Don't stubbornly.</li>--}}
                    {{--<li>Principle to work to make more money while having more fun.</li>--}}
                    {{--<li>Space in your house How to sell faster than your neighbors</li>--}}
                {{--</ul>--}}


            {{--</div>--}}
            <div class="col-sm-6 col-md-4">
                <div class="size-price">Price<span>$ {{number_format($phong->giatien)}} / Night</span></div>
            </div>
            <div class="col-sm-6 col-md-4" style="float: right; margin-top: 50px">
                @if($phong->tinhtrang == 0)
                    <a href="book/{{$phong->id}}" class="btn btn-default" style="height: 50px; display: flex; align-items: center; justify-content: center">Đặt Phòng Ngay</a>
                @else
                    <a href="" class="btn btn-default" style="height: 50px; display: flex; align-items: center; justify-content: center;pointer-events: none;">Đặt Phòng Ngay</a>
                    <p style="color: red">This room was booked by a customer.<br> Please try again later.</p>
                @endif
            </div>
        </div>

    </div>




</div>
@include('footer')