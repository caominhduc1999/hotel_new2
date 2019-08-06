@include('header')




<!-- banner -->
<div class="banner">
    <img src="hotel_asset/images/photos/banner.jpg"  class="img-responsive" alt="slide">
    <div class="welcome-message">
        <div class="wrap-info">
            <div class="information">
                <h1  class="animated fadeInDown">Best hotel in Dubai</h1>
                <p class="animated fadeInUp">Most luxurious hotel of asia with the royal treatments and excellent customer service.</p>
            </div>
            <a href="#information" class="arrow-nav scroll wowload fadeInDownBig"><i class="fa fa-angle-down"></i></a>
        </div>
    </div>
</div>
<!-- banner-->


<!-- reservation-information -->
<div id="information" class="spacer reserve-info ">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-md-8">
                <div class="embed-responsive embed-responsive-16by9 wowload fadeInLeft"><iframe  class="embed-responsive-item" src="//player.vimeo.com/video/55057393?title=0" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
            </div>
            <div class="col-sm-5 col-md-4">
                <div>
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                </div>
                <h3>Reservation</h3>
                {{--app/Http/Middleware/VerifyCsrfToken.php--}}
                {{--protected $except = [--}}
                {{--'your/route'--}}
                {{--];--}}
                <form action="{{route('datphongluon')}}" class="wowload fadeInRight" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control"  placeholder="Name" name="hoten" value="{{old('hoten')}}">
                    </div>
                    @if ($errors->has('hoten'))
                        <div class="alert alert-danger">
                            {{ $errors->first('hoten') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <input type="email" class="form-control"  placeholder="Email" name="email" value="{{old('email')}}">
                    </div>
                    @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <input type="text" class="form-control"  placeholder="Phone" name="sdt" value="{{old('sdt')}}">
                    </div>
                    @if ($errors->has('sdt'))
                        <div class="alert alert-danger">
                            {{ $errors->first('sdt') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Book Date :</label>
                        <input type="date" min="today" class="form-control" name="ngayden" value="{{old('ngayden')}}">
                    </div>
                    @if ($errors->has('ngayden'))
                        <div class="alert alert-danger">
                            {{ $errors->first('ngayden') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Leave Date :</label>
                        <input type="date" min="today" class="form-control" name="ngaytra" value="{{old('ngaytra')}}">
                    </div>
                    @if ($errors->has('ngaytra'))
                        <div class="alert alert-danger">
                            {{ $errors->first('ngaytra') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <textarea class="form-control"  placeholder="Message" rows="5"></textarea>
                    </div>
                    <button class="btn btn-default" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- reservation-information -->



<!-- services -->
<div class="spacer services wowload fadeInUp">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <!-- RoomCarousel -->
                <div id="RoomCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active"><img src="hotel_asset/images/photos/8.jpg" class="img-responsive" alt="slide"></div>
                        <div class="item  height-full"><img src="hotel_asset/images/photos/9.jpg"  class="img-responsive" alt="slide"></div>
                        <div class="item  height-full"><img src="hotel_asset/images/photos/10.jpg"  class="img-responsive" alt="slide"></div>
                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#RoomCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                    <a class="right carousel-control" href="#RoomCarousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
                </div>
                <!-- RoomCarousel-->
                <div class="caption">Rooms</div>
            </div>


            <div class="col-sm-4">
                <!-- RoomCarousel -->
                <div id="TourCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active"><img src="hotel_asset/images/photos/6.jpg" class="img-responsive" alt="slide"></div>
                        <div class="item  height-full"><img src="hotel_asset/images/photos/3.jpg"  class="img-responsive" alt="slide"></div>
                        <div class="item  height-full"><img src="hotel_asset/images/photos/4.jpg"  class="img-responsive" alt="slide"></div>
                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#TourCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                    <a class="right carousel-control" href="#TourCarousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
                </div>
                <!-- RoomCarousel-->
                <div class="caption">Tour Packages</div>
            </div>


            <div class="col-sm-4">
                <!-- RoomCarousel -->
                <div id="FoodCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active"><img src="hotel_asset/images/photos/1.jpg" class="img-responsive" alt="slide"></div>
                        <div class="item  height-full"><img src="hotel_asset/images/photos/2.jpg"  class="img-responsive" alt="slide"></div>
                        <div class="item  height-full"><img src="hotel_asset/images/photos/5.jpg"  class="img-responsive" alt="slide"></div>
                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#FoodCarousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                    <a class="right carousel-control" href="#FoodCarousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
                </div>
                <!-- RoomCarousel-->
                <div class="caption">Food and Drinks</div>
            </div>
        </div>
    </div>
</div>
<!-- services -->


@include('footer')