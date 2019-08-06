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
                <a style="text-decoration:none; color:inherit" href=""><p class="list-group-item">{{$lp->tenloaiphong}}</p></a>
                @endforeach
            </ul>
        </div>

    </div>


    <div class="row">
        @foreach($phong as $p)
            <div class="col-sm-6 wowload fadeInUp"><div class="rooms">
                    <img width="600px" src="anhdaidien/{{$p->anhdaidien}}" class="img-responsive">
                    <div class="info">
                        <h3>{{$p->tenphong}}</h3><a href="room_details/{{$p->id}}" class="btn btn-default">Chi tiết</a><span> </span><a href="room_details" class="btn btn-default">Đặt Phòng</a>
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