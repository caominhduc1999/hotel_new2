@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh sách Thuê Phòng
                        <small>
                            <a class="btn btn-success" href="admin/thuephong/them">Thêm Thuê Phòng</a>
                        </small>
                        <div>
                            <form  action="admin/thuephong/timkiem" role="search" method="get">
                                <div class="input-group custom-search-form">
                                    <input style="width: 300px; float: right" type="text"  class="form-control" name="key" placeholder="Search...">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                                </div>
                            </form>
                        </div>
                    </h1>
                </div>
                <div>
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                </div>
                <!-- /.col-lg-12 -->

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Khách Hàng</th>
                        <th>Email Khách Hàng</th>
                        <th>Nhân Viên Quyết Toán</th>
                        <th>Phòng</th>
                        <th>Ngày đặt</th>
                        <th>Ngày đến</th>
                        <th>Ngày trả</th>
                        <th>Tổng Tiền</th>
                        <th>Ghi Chú</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($danhsachthuephong as $dsthuephong)
                        <tr class="odd gradeX" align="center">
                            <td>{{$dsthuephong->id}}</td>
                            <td>{{$dsthuephong->khachhang->hoten}}</td>
                            <td>{{$dsthuephong->email}}</td>
                            <td>
                                @if($dsthuephong->id_nhanvien)
                                    {{$dsthuephong->nhanvien->hoten}}
                                @else
                                    {{'...'}}
                                @endif
                            </td>
                            <td>
                                @foreach($phong as $p)
                                    @if($dsthuephong->id_phong == $p->id)
                                        {{$p->tenphong}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$dsthuephong->created_at}}</td>
                            <td>{{$dsthuephong->ngayden}}</td>
                            <td>{{$dsthuephong->ngaytra}}</td>
                            <td>{{$dsthuephong->tongtien}}</td>
                            <td>{{$dsthuephong->ghichu}}</td>

                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/thuephong/xoa/{{$dsthuephong->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/thuephong/sua/{{$dsthuephong->id}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        {{$danhsachthuephong->links()}}
    </div>
    <!-- /#page-wrapper -->

@endsection