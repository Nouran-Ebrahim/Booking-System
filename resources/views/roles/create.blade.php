@extends('layouts.master')
@section('title')
    Roles
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Roles</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @can('Index-role')
                                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Home</a></li>
                            @endcan
                            <li class="breadcrumb-item active">Create Role</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6 col-lg-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create Role</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.roles.store') }}" method="POST">
                                @csrf
                                @method('post')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input name="name" type="text" value="{{ old('name') }}"
                                            class="form-control" id="exampleInputEmail1" placeholder="Enter Role Name">
                                        @error('name')
                                            <p class="alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 col-lg-12">
                                            <!-- checkbox -->
                                            <div class="form-group">
                                                @foreach ($cat_permissions as $key => $value)
                                                    {{ $key }}
                                                    @foreach ($value as $permission)
                                                        <div class="form-check">
                                                            <input name="permission[]" value="{{ $permission->name }}"
                                                                class="form-check-input" type="checkbox">
                                                            <label class="form-check-label">{{ $permission->name }}</label>
                                                        </div>
                                                    @endforeach
                                                @endforeach


                                            </div>
                                        </div>

                                    </div>
                                </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.card -->



                </div>

            </div>
            <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
