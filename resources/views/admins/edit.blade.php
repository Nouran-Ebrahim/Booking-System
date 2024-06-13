@extends('layouts.master')
@section('title')
    Admins
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Admins</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @can('Index-admin')
                            <li class="breadcrumb-item"><a href="{{route('admin.admins.index')}}">Home</a></li>
                            @endcan
                            <li class="breadcrumb-item active">Edit Admin</li>
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
                                <h3 class="card-title">Edit Admin</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.admins.update',$admin->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail5">Name</label>
                                        <input type="text" name="name" value="{{$admin->name}}" class="form-control" id="exampleInputEmail5"
                                            placeholder="Enter Name">
                                    </div>
                                    @error('name')
                                        <p class="alert-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" name="email" value="{{$admin->email}}" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter email">
                                    </div>
                                    @error('email')
                                        <p class="alert-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input name="password"  type="password" class="form-control"
                                            id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    @error('password')
                                        <p class="alert-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select name="role" class="form-control form-select" style="width: 100%;">
                                            @foreach ($roles as $role)
                                                <option @if (in_array($role->name, $userRole)) selected @endif value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                                            @endforeach
                                        </select>
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

