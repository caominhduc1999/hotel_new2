@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh sách Ảnh
                        <small>
                            <a class="btn btn-success" href="admin/anh/them">Thêm Ảnh</a>
                        </small>
                        <div>
                            <form  action="admin/anh/timkiem" role="search" method="get">
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
                    <div>
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /.col-lg-12 -->

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Phòng chứa ảnh</th>
                        <th>Ảnh</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($danhsachanh as $dsanh)
                        <tr class="odd gradeX" align="center">
                            <td>{{$dsanh->id}}</td>
                            <td>{{$dsanh->phong->tenphong}}</td>
                            <td>
                                <img width="200px" height="150px" src="/images/{{$dsanh->tenanh}}" alt="">
                            </td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/anh/xoa/{{$dsanh->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/anh/sua/{{$dsanh->id}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        {{ $danhsachanh->links() }}
    </div>
    <!-- /#page-wrapper -->

@endsection

