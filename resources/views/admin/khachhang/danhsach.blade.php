@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh sách Khách Hàng
                        <small>
                            <a class="btn btn-success" href="admin/khachhang/them">Thêm Khách Hàng</a>
                        </small>
                        <div>
                            <form  action="admin/khachhang/timkiem" role="search" method="get">
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
                        <th>Họ Tên</th>
                        <th>Email</th>
                        <th>Giới tính</th>
                        <th>Ngày Sinh<br>(Y - M - D)</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Căn cước công dân</th>
                        <th>Quốc tịch</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($danhsachkhachhang as $dskhachhang)
                        <tr class="odd gradeX" align="center">
                            <td>{{$dskhachhang->id}}</td>
                            <td>{{$dskhachhang->hoten}}</td>
                            <td>{{$dskhachhang->email}}</td>
                            <td>
                                @if($dskhachhang->gioitinh == 1)
                                    {{'Nam'}}
                                @elseif($dskhachhang->gioitinh == 2)
                                    {{'Nữ'}}
                                @else
                                    {{'...'}}
                                @endif
                            </td>
                            <td>{{$dskhachhang->ngaysinh}}</td>
                            <td>{{$dskhachhang->sdt}}</td>
                            <td>{{$dskhachhang->diachi}}
                                @if(empty($dskhachhang->diachi))
                                    {{'...'}}
                                @endif
                            </td>
                            <td>{{$dskhachhang->cccd}}
                                @if(empty($dskhachhang->cccd))
                                    {{'...'}}
                                @endif
                            </td>
                            <td>{{$dskhachhang->quoctich}}
                                @if(empty($dskhachhang->quoctich))
                                    {{'...'}}
                                @endif
                            </td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/khachhang/xoa/{{$dskhachhang->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/khachhang/sua/{{$dskhachhang->id}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        {{$danhsachkhachhang->links()}}
    </div>
    <!-- /#page-wrapper -->

@endsection