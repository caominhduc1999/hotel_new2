@include('header')
<div class="container">

    <h2>Rooms & Tariff</h2>

    <style>
        .list-group-item:hover{
            background: grey;
            color: white;
            cursor: pointer;
        }

    </style>
    <!-- form -->
    <div class="row list-phong" style="position: fixed; left: 0; border: 0.8px solid grey; z-index: 50" >
        <div>
            <ul class="list-group ">
                @foreach($loaiphong as $lp)
                <a style="text-decoration:none; color:inherit" href="rooms_tariff/loaiphong/{{$lp->id}}"><p class="list-group-item">{{$lp->tenloaiphong}}</p></a>
                @endforeach
            </ul>
        </div>

    </div>


    <div class="row">
        @foreach($phong as $p)
            <div class="col-sm-6 wowload fadeInUp"><div class="rooms">
                    <img width="600px" src="anhdaidien/{{$p->anhdaidien}}" class="img-responsive">
                    <div class="info">
                        <h3>{{$p->tenphong}}</h3><a href="room_details/{{$p->id}}" class="btn btn-default">Chi tiết</a><span> </span>
                        @if($p->tinhtrang == 0)
                            <a href="book/{{$p->id}}" class="btn btn-default">Đặt Phòng</a>
                        @else
                            <a class="btn btn-default" style="color: red; pointer-events: none">Booked</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <div class="text-center">
        <div class="pagination">
            {{$phong->links()}}
        </div>
    </div>


</div>
@include('footer')