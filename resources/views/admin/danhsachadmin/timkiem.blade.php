@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh sách Admin
                        <small>
                            <a class="btn btn-success" href="admin/danhsachadmin/them">Thêm Admin</a>
                        </small>
                        <div>
                            <form  action="admin/danhsachadmin/timkiem" role="search" method="get">
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
                        <th>FullName</th>
                        <th>Phone</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($search as $dsadmin)
                        <tr class="odd gradeX" align="center">
                            <td>{{$dsadmin->id}}</td>
                            <td>{{$dsadmin->fullname}}
                                @if(empty($dsadmin->fullname))
                                    {{'...'}}
                                @endif
                            </td>
                            <td>{{$dsadmin->phone}}
                                @if(empty($dsadmin->phone))
                                    {{'...'}}
                                @endif
                            </td>

                            <td>{{$dsadmin->email}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/danhsachadmin/xoa/{{$dsadmin->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/danhsachadmin/sua/{{$dsadmin->id}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection