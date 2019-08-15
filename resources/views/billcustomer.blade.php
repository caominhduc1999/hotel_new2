@include('header')
<br>
<br>
<br>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-md-12">
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                <thead>
                <tr align="center">
                    <th>Tên Phòng</th>
                    <th>Ảnh Phòng</th>
                    <th>Ngày Đến</th>
                    <th>Ngày Trả</th>
                    <th>Tiền Phòng</th>
                    <th>Thao Tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($thuephong as $t)
                    <tr class="odd gradeX" align="center">
                        <td>
                            @foreach($phong as $p)
                                @if($t->id_phong == $p->id)
                                    {{$p->tenphong}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($phong as $p)
                                @if($t->id_phong == $p->id)
                                    <img width="200px" height="100px" src="anhdaidien/{{$p->anhdaidien}}" alt="">
                                @endif
                            @endforeach
                        </td>

                        <td>{{$t->ngayden}}</td>
                        <td>{{$t->ngaytra}}</td>
                        <td>${{number_format($t->tongtien)}} / đêm</td>

                        <td class="center btn btn-success"><i class="fa fa-pencil fa-fw"></i><a style="color: inherit" href="customer/bill/edit/{{$t->id}}">Edit</a></td>&nbsp;
                        <td class="center btn btn-danger"><i class="fa fa-trash-o  fa-fw"></i><a style="color: inherit" href="customer/bill/delete/{{$t->id}}"> Delete</a></td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
@include('footer')