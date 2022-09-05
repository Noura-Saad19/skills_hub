@extends('admin.layout')
@section('main')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Message</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{url('dashboard/messages')}}">Messages</a></li>
                            <li class="breadcrumb-item active">Show Messages</li>

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
                        @include('admin.inc.messages')
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title">Message</h3>

                            </div>
                            <div class="card-body p-0">
                                <table class="table table-md">

                                    <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{$messages->name}}</td>
                                    </tr>

                                    <tr>
                                        <th>Email</th>
                                        <td>{{$messages->email}}</td>
                                    </tr>
                                    <tr>
                                        <th>Subject</th>
                                        <td>{{$messages->subject ?? "..." }}</td>
                                    </tr>
                                    <tr>
                                        <th>Body</th>
                                        <td>{{$messages->body}}</td>
                                    </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Send Response</h3>
                            </div>
                            <form method="post" action="{{url("dashboard/messages/response/$messages->id")}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input class="form-control" type="text" name="title">

                                    </div>
                                    <div class="form-group">
                                        <label>Body</label>
                                        <textarea class="form-control" rows="5" name="body">
                                                </textarea>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                                    </div>
                                </div>
                            </form>

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


