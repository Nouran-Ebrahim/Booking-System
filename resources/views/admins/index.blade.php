@extends('layouts.master')
@section('title')
    Admins
@endsection
@section('css')
    <style>
        @media (max-width: 533px) {
            .card-body {
                overflow-x: scroll;
            }
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Admins</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @can('Index-admin')
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            @endcan
                            <li class="breadcrumb-item active">Admins</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admin</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            {{-- <i class="fas fa-times"></i> --}}
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    #
                                </th>
                                <th style="width: 20%">
                                    Name
                                </th>
                                <th style="width: 20%">
                                    Email
                                </th>
                                <th style="width: 20%">
                                    Role
                                </th>

                                <th style="width: 20%">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $admin->name }}
                                    </td>
                                    <td>
                                        {{ $admin->email }}
                                    </td>
                                    <td>
                                        {{ $admin['roles'][0]['name'] }}
                                    </td>
                                    @if (auth()->user()->can('Edit-admin') || auth()->user()->can('Delete-admin'))
                                        <td class="project-actions text-right">
                                            @can('Edit-admin')
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('admin.admins.edit', $admin->id) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                            @endcan

                                            @can('Delete-admin')
                                                @if (auth()->user()->id !== $admin->id)
                                                    <a class="btn btn-danger btn-sm delete" data-id="{{ $admin->id }}"
                                                        href="#">
                                                        <i class="fas fa-trash"></i>
                                                        Delete
                                                    </a>
                                                @endif
                                            @endcan


                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script>
        $('.delete').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var token = $("meta[name='csrf-token']").attr("content");

            Swal.fire({
                text: "Are you sure you want to delete this item ?",
                icon: 'warning',
                confirmButtonText: 'yes',
                cancelButtonText: 'no',
                showCancelButton: true,

            }).then(function(result) {
                if (result.value) {

                    $.ajax({
                        url: window.location.origin + "/admin/admins/" + id,
                        type: 'post',
                        data: {
                            "id": id,
                            "_method": "DELETE",
                            "_token": token
                        },

                        success: function() {
                            window.location.reload();
                        }
                    });

                }
            });
        })
    </script>
@endsection
