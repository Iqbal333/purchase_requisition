@extends('layouts.app')
@section('content')

<div class="page-heading">
    <h3>Daftar Permintaan Barang</h3>
</div>

<div class="container">
    <div class="justify-content-center">

        @include('includes.notification')

        <div class="card">
            <div class="card-header">Request Items
                @can('request_items-create')
                    <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('request_items.create') }}">New Request Items</a>
                    </span>
                @endcan
            </div>
            <div class="card-body">
                <form action="{{ url('reject') }}" method="GET">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" value="{{ old('start_date', date('Y-m-d')) }}" name="start_date">
                        <input type="date" class="form-control" value="{{ old('end_date', date('Y-m-d')) }}" name="end_date">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
                <table class="table table-hover" id="table1">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Request Number</th>
                            <th>Name</th>
                            <th>Division</th>
                            <th>Description</th>
                            <th>Request Date</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($request_items as $key => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->request_no }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->division->division_name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    @can('list_request-show')
                                        <a class="btn btn-success" href="{{ route('list_request.show', $item->id) }}">Show</a>
                                    @endcan
                                    @can('list_request-edit')
                                        <a class="btn btn-primary" href="{{ route('list_request.edit', $item->id) }}">Edit</a>
                                    @endcan
                                    @can('request_items-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['request_items.destroy', $item->id], 'onsubmit' => 'return confirm("Anda yakin akan menghapus data ini?")', 'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
     <script>
        $(document).ready(function () {
        $('#table1').DataTable( {
            dom: 'Bfrltip',

          "lengthMenu" : [[25, 50, -1], [25, 50, "All"]],
            buttons: [{
                        extend: 'pdf',
                        text: '<i class="bi bi-file-earmark-pdf">&nbsp; PDF</i>',
                        className: 'btn btn-sm btn-outline-danger'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="bi bi-file-earmark-excel">&nbsp; Excel</i>',
                        className: 'btn btn-sm btn-outline-success'
                    },
                ]
          });
        });
    </script>
@endpush
