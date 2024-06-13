@extends('layouts.master')
@section('title')
    Rooms
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

                    <div class="col-sm-4">
                        <h1>Rooms</h1>
                    </div>
                    <div class="col-sm-4">
                        <form class="input-group" method="GET">
                            <input value="{{ @$_GET['title'] }}" name="title" class="form-control " type="search"
                                placeholder="Search" aria-label="Search">
                            {{-- <div class="input-group-append"> --}}
                            <button type="submit" class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                            {{-- </div> --}}
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            @can('Index-room')
                                <li class="breadcrumb-item"><a href="{{ route('admin.rooms.index') }}">Home</a></li>
                            @endcan
                            <li class="breadcrumb-item active">Rooms</li>
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
                    <h3 class="card-title">Rooms</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            {{-- <i class="fas fa-times"></i> --}}
                        </button>
                    </div>
                </div>
                @if ($rooms->count() > 0)
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 1%">
                                        #
                                    </th>
                                    <th style="width: 20%">
                                        title
                                    </th>
                                    <th style="width: 10%">
                                        price
                                    </th>
                                    <th style="width: 10%">
                                        type
                                    </th>
                                    <th style="width: 10%">
                                        status
                                    </th>
                                    <th style="width: 10%">
                                        Image
                                    </th>
                                    <th style="width: 20%">

                                    </th>
                                    @if (auth()->user()->can('Edit-room') || auth()->user()->can('Delete-room'))
                                        <th style="width: 20%">
                                        </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $room->title }}
                                        </td>
                                        <td>
                                            {{ $room->price }}
                                        </td>
                                        <td>
                                            {{ $room->type }}
                                        </td>
                                        <td>
                                            {{ $room->status }}
                                        </td>
                                        <td class="text-center">
                                            <img class="image-fluid w-100" src="{{ $room->image }}">
                                        </td>
                                        <td class="text-center">
                                            <button data-room_id="{{ $room->id }}" data-status="{{ $room->status }}"
                                                type="button" class="btn btn-default" data-toggle="modal"
                                                data-target="#modal-default">
                                                Change Status
                                            </button>
                                        </td>
                                        @if (auth()->user()->can('Edit-room') || auth()->user()->can('Delete-room'))
                                            <td class="project-actions text-right">
                                                @can('Edit-room')
                                                    <a class="btn btn-info btn-sm"
                                                        href="{{ route('admin.rooms.edit', $room->id) }}">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Edit
                                                    </a>
                                                @endcan

                                                @can('Delete-room')
                                                    <a class="btn btn-danger btn-sm delete" data-id="{{ $room->id }}"
                                                        href="#">
                                                        <i class="fas fa-trash"></i>
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
                @else
                    <div class="card-body p-0">

                        <p class="text-center">
                            No Data
                        </p>


                    </div>
                @endif

                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Change Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.roomsChangeStatus') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="room_id" id="room_id" value="">


                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Status</label>
                        <select name="status" id="status" class="custom-select my-1 mr-sm-2" required>

                            <option value="available">Available</option>
                            <option value="pending">Pending</option>
                            <option value="booked">Booked</option>

                        </select>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('js')
    <script>
        $('#modal-default').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var status = button.data('status')
            var room_id = button.data('room_id')
            var modal = $(this)
            modal.find('.modal-body #status').val(status);
            modal.find('.modal-body #room_id').val(room_id);
        })
    </script>
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
                        url: window.location.origin + "/admin/rooms/" + id,
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
