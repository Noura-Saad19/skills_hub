@extends('admin.layout')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Categories</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Categories</h3>
                                <div class="card-tools">

                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                            data-target="#modal-lg">
                                        Add New
                                    </button>
                                    {{--                                    <a href="#" class="btn btn-sm btn-primary ">Add New</a>--}}
                                </div>
                            </div>


                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name (en)</th>
                                        <th>Name (ar)</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cats as $cat)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$cat->name('en')}}</td>
                                            <td>{{$cat->name('ar')}}</td>
                                            <td>
                                                @if($cat->active)
                                                    <span class="badge bg-success">yes</span>
                                                @else
                                                    <span class="badge bg-danger">no</span>
                                                @endif
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-sm btn-info"
                                                        data-toggle="modal"
                                                        data-target="#edit-modal">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="{{url("dashboard/categories/delete/$cat->id")}}"
                                                   class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="my-4 d-flex justify-content-center">
                                    {{$cats->links()}}

                                </div>
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
    {{--    Create Category--}}
    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body my-3">
                    <form id="add-form" method="post" action="{{url('dashboard/categories/store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (en)</label>
                                    <input type="text" name="name_en" class="form-control" id=""
                                           placeholder="Enter Name In English">
                                </div>
                            </div>
                            <div class="col-6">

                                <div class="form-group">
                                    <label>Name (ar)</label>
                                    <input type="text" name="name_ar" class="form-control" id=""
                                           placeholder="Enter Name In Arabic">
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="add-form" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </div>

    </div>
    {{--End of create Category--}}

    {{--Update Category--}}
    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body my-3">
                    <form id="edit-form" method="post" action="{{url('dashboard/categories/update')}}">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (en)</label>
                                    <input type="text" name="name_en" class="form-control" id=""
                                           placeholder="Enter Name In English">
                                </div>
                            </div>
                            <div class="col-6">

                                <div class="form-group">
                                    <label>Name (ar)</label>
                                    <input type="text" name="name_ar" class="form-control" id=""
                                           placeholder="Enter Name In Arabic">
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="edit-form" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </div>

    </div>
    {{--End of Update Category--}}

@endsection
