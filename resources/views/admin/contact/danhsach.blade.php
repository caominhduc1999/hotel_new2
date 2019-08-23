@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh sách liên hệ
                        <small>
                            <a class="btn btn-success" href="admin/thuephong/them">Thêm liên hệ</a>
                        </small>
                        <div>
                            <form  action="contact/timkiem" role="search" method="get">
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
                        <th>Khách Hàng</th>
                        <th>Ghi Chú</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contact as $contact)
                        <tr class="odd gradeX" align="center">
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->content}}</td>

                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="contact/xoa/{{$contact->id}}"> Delete</a></td>
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