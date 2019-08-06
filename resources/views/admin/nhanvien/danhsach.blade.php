@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh sách Nhân Viên
                        <small>
                            <a class="btn btn-success" href="admin/nhanvien/them">Thêm Nhân Viên</a>
                        </small>
                    </h1>
                    <div>
                        <form  action="admin/nhanvien/timkiem" role="search" method="get">
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
                        <th>Giới tính</th>
                        <th>Ngày Sinh (Y - M - D)</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Căn cước công dân</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($danhsachnhanvien as $dsnhanvien)
                        <tr class="odd gradeX" align="center">
                            <td>{{$dsnhanvien->id}}</td>
                            <td>{{$dsnhanvien->hoten}}</td>
                            <td>
                                @if($dsnhanvien->gioitinh == 1)
                                    {{'Nam'}}
                                @else
                                    {{'Nữ'}}
                                @endif
                            </td>
                            <td>{{$dsnhanvien->ngaysinh}}</td>
                            <td>{{$dsnhanvien->sdt}}</td>
                            <td>{{$dsnhanvien->diachi}}</td>
                            <td>{{$dsnhanvien->cccd}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/nhanvien/xoa/{{$dsnhanvien->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/nhanvien/sua/{{$dsnhanvien->id}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        {{$danhsachnhanvien->links()}}
    </div>
    <!-- /#page-wrapper -->

@endsection