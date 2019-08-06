@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh sách Phòng
                        <small>
                            <a class="btn btn-success" href="admin/phong/them">Thêm Phòng</a>
                        </small>
                        <div>
                            <form  action="admin/phong/timkiem" role="search" method="get">
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
                        <th>Tên Phòng</th>
                        <th>Loại Phòng</th>
                        <th>Tình Trạng</th>
                        <th>Thông Tin</th>
                        <th>Giá Tiền / Đêm</th>
                        <th>Ảnh Đại Diện</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($danhsachphong as $dsphong)
                        <tr class="odd gradeX" align="center">
                            <td>{{$dsphong->id}}</td>
                            <td>{{$dsphong->tenphong}}</td>
                            <td>{{$dsphong->loaiphong->tenloaiphong}}</td>
                            <td>
                                @if($dsphong->tinhtrang == 1)
                                    {{'Đầy'}}
                                @else
                                    {{'Trống'}}
                                @endif
                            </td>
                            <td>{!! htmlspecialchars_decode($dsphong->thongtin) !!}
                                @if(empty($dsphong->thongtin))
                                    {{'...'}}
                                @endif
                            </td>
                            <td>{{number_format($dsphong->giatien)}}</td>
                            <td>
                                <img width="200px" height="150px" src="/anhdaidien/{{$dsphong->anhdaidien}}" alt="">
                            </td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/phong/xoa/{{$dsphong->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/phong/sua/{{$dsphong->id}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        {{$danhsachphong->links()}}
    </div>
    <!-- /#page-wrapper -->

@endsection