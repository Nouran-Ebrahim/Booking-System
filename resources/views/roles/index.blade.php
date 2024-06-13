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
                        <h1>Roles</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @can('Index-role')
                                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Home</a></li>
                            @endcan
                            <li class="breadcrumb-item active">Roles</li>
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
                    <h3 class="card-title">Roles</h3>

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
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $role->name }}
                                    </td>
                                    @if (auth()->user()->can('Edit-role') || auth()->user()->can('Delete-role'))
                                        <td class="project-actions text-right">
                                            @can('Edit-role')
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('admin.roles.edit', $role->id) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit
                                                </a>
                                            @endcan
                                            @can('Delete-role')
                                                <a class="btn btn-danger btn-sm delete" data-id="{{ $role->id }}"
                                                    href="#">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Delete
                                                </a>
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
                        url: window.location.origin + "/admin/roles/" + id,
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
