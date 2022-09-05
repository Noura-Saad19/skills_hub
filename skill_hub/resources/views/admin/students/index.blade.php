@extends('admin.layout')
@section('main')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Students</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{url("dashboard/students")}}">Students</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 offset-md-1 pb-3">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title">All Students</h3>
                            </div>

                            <div class="card-body p-0">
                                <table class="table table-md">
                                    <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Verified</th>
                                    <th>Actions</th>
                                    </thead>


                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>   @if($student->email_verified_at !==null)
                                                    <span class="badge bg-success">yes</span>
                                                @else
                                                    <span class="badge bg-danger">no</span>

                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{url("/dashboard/students/show-scores/{$student->id}")}}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-percent"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection


