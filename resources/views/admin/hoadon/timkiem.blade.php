@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh sách Hóa Đơn
                        <div>
                            <form  action="admin/hoadon/timkiem" role="search" method="get">
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
                        <th>Nhân Viên Quyết Toán</th>
                        <th>Tổng Thanh Toán</th>
                        <th>Ngày Thanh Toán</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($search as $dshoadon)
                        <tr class="odd gradeX" align="center">
                            <td>{{$dshoadon->id}}</td>
                            <td>
                                @foreach($khachhang as $kh)
                                    @if($kh->id == $dshoadon->id_khachhang)
                                        {{$kh->hoten}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($nhanvien as $nv)
                                    @if($nv->id == $dshoadon->id_nhanvien)
                                        {{$nv->hoten}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$dshoadon->tongthanhtoan}}</td>
                            <td>{{$dshoadon->ngaythanhtoan}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/hoadon/xoa/{{$dshoadon->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/hoadon/sua/{{$dshoadon->id}}"> Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        {{$search->links()}}
    </div>
    <!-- /#page-wrapper -->

@endsection