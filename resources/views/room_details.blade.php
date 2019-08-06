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
        <div class="row">
            <div class="col-sm-12 col-md-8" style="overflow: hidden">
                <p>{!! htmlspecialchars_decode($phong->thongtin) !!}</p>
            </div>
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
                <a href="room_details" class="btn btn-default" style="height: 50px; display: flex; align-items: center; justify-content: center">Đặt Phòng Ngay</a>
            </div>
        </div>

    </div>




</div>
@include('footer')