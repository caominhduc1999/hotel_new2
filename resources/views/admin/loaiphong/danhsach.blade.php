@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh sách Loại Phòng
                        <small>
                            <a class="btn btn-success" href="admin/loaiphong/them">Thêm Loại Phòng</a>
                        </small>
                    </h1>
                    <div>
                        <form  action="admin/loaiphong/timkiem" role="search" method="get">
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
                        <th>Tên Loại Phòng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($danhsachloaiphong as $dsloaiphong)
                        <tr class="odd gradeX" align="center">
                            <td>{{$dsloaiphong->id}}</td>
                            <td>{{$dsloaiphong->tenloaiphong}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/loaiphong/xoa/{{$dsloaiphong->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/loaiphong/sua/{{$dsloaiphong->id}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        {{$danhsachloaiphong->links()}}
    </div>
    <!-- /#page-wrapper -->

@endsection