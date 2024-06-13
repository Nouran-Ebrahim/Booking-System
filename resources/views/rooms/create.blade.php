@extends('layouts.master')
@section('title')
    Rooms
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Rooms</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @can('Index-room')
                                <li class="breadcrumb-item"><a href="{{ route('admin.rooms.index') }}">Home</a></li>
                            @endcan
                            <li class="breadcrumb-item active">Create Room</li>
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
                                <h3 class="card-title">Create Room</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form enctype="multipart/form-data" action="{{ route('admin.rooms.store') }}" method="POST">
                                @csrf
                                @method('post')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail5">Title</label>
                                        <input type="text" name="title" value="{{ old('title') }}"
                                            class="form-control" id="exampleInputEmail5" placeholder="Enter Title">
                                        @error('title')
                                            <p class="alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="number" step="any" min="1" value="{{ old('price') }}"
                                            name="price" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter Price">
                                        @error('price')
                                            <p class="alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input accept="image" type="file" accept="image/*" name="image"
                                            class="form-control" id="image">
                                        @error('image')
                                            <p class="alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>type</label>
                                        <select name="type" class="form-control form-select" style="width: 100%;">
                                            <option value="single">Single</option>
                                            <option value="double">Double</option>
                                            <option value="suite">Suite</option>

                                        </select>
                                        @error('type')
                                            <p class="alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control form-select" style="width: 100%;">
                                            <option value="available">Available</option>
                                            <option value="pending">Pending</option>
                                            <option value="booked">Booked</option>

                                        </select>
                                        @error('status')
                                            <p class="alert-danger">{{ $message }}</p>
                                        @enderror
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
