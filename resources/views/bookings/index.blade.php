@extends('layouts.master')
@section('title')
    Bookings
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
                        <h1>Bookings</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @can('Index-booking')
                                <li class="breadcrumb-item"><a href="{{ route('admin.bookings.index') }}">Home</a></li>
                            @endcan

                            <li class="breadcrumb-item active">Bookings</li>
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
                    <h3 class="card-title">Bookings</h3>

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
                                    Room
                                </th>
                                <th style="width: 20%">
                                    client
                                </th>

                                <th style="width: 20%">
                                    status
                                </th>
                                <th style="width: 20%">
                                    created at
                                </th>
                                <th style="width: 20%">

                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $booking->room->title }}
                                    </td>
                                    <td>
                                        {{ $booking->client->name }}
                                    </td>
                                    <td>
                                        @if ($booking->status == 'reject')
                                            Rejected
                                        @elseif ($booking->status == 'approve')
                                            Approved
                                        @else
                                            Pending
                                        @endif
                                    </td>
                                    <td>
                                        {{ $booking->created_at->format('Y-m-d') }}
                                    </td>

                                    <td class="text-center">
                                        @if ($booking->room->deleted_at == null && $booking->client->deleted_at == null)
                                            <button data-booking_id="{{ $booking->id }}"
                                                data-status="{{ $booking->status }}" type="button" class="btn btn-default"
                                                data-toggle="modal" data-target="#modal-default">
                                                Change Status
                                            </button>
                                        @else
                                            @if ($booking->room->deleted_at != null && $booking->client->deleted_at != null)
                                                Client and Room are not available
                                            @elseif ($booking->room->deleted_at != null)
                                                This Room is not available
                                            @elseif ($booking->client->deleted_at != null)
                                                This Client not available
                                            @endif
                                        @endif


                                    </td>








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
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Change Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.bookings.update', 'test') }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="booking_id" id="booking_id" value="">


                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Status</label>
                        <select name="status" id="status" class="custom-select my-1 mr-sm-2" required>

                            <option value="approve">Approve</option>
                            <option value="pending">Pending</option>
                            <option value="reject">Reject</option>

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
            var button = $(event.relatedTarget);
            var status = button.data('status');
            var booking_id = button.data('booking_id');
            var modal = $(this);
            var select = modal.find('.modal-body #status');
            select.empty();

            if (status === 'reject') {
                select.append('<option value="reject" selected>Rejected</option>');
                select.append('<option value="pending" >Pending</option>');
            } else if (status === 'approve') {
                select.append('<option value="approve"  selected>Approved</option>');
                select.append('<option value="reject" >Reject</option>');

            } else {
                select.append('<option value="approve">Approve</option>');
                select.append('<option value="pending"  selected>Pending</option>');
                select.append('<option value="reject">Reject</option>');

            }
            select.val(status)
            modal.find('.modal-body #booking_id').val(booking_id);

            var actionUrl = "{{ route('admin.bookings.update', ':booking_id') }}";
            actionUrl = actionUrl.replace(
                ':booking_id', booking_id);
            modal.find('form').attr('action', actionUrl);

        })
    </script>
@endsection
