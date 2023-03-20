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
                {{-- <a class="btn btn-sm btn-danger" href="{{ url('/report') }}"><i class="bi bi-file-earmark-pdf">&nbsp; PDF</i></a> --}}
                <div class="my-2">
                    <form action="{{ url('approve') }}" method="GET">
                        @csrf
                        <div class="input-group mb-3 input-daterange">
                            <input type="date" class="form-control" value="{{ old('start_date', date('Y-m-d')) }}" name="start_date">
                            <input type="date" class="form-control" value="{{ old('end_date', date('Y-m-d')) }}" name="end_date">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
                <table class="table table-hover" id="table1">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Request Number</th>
                            <th>Name</th>
                            <th>Division</th>
                            <th>Request Date</th>
                            <th>Description</th>
                            <th>Action</th>
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
            var currentdate = new Date();
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            const d = new Date();

            var datetime = "Dicetak Tanggal " + currentdate.getDate() + " "
                        + monthNames[d.getMonth()]  + " "
                        + currentdate.getFullYear() + " "
                        + currentdate.getHours() + ":"
                        + currentdate.getMinutes() + " WIB";

        $('#table1').DataTable( {
            dom: 'Bfrltip',

          "lengthMenu" : [[25, 50, -1], [25, 50, "All"]],
            buttons: [{
                        extend: 'pdf',
                        messageTop: datetime,
                        title: function() {
                            return "Laporan Permintaan Barang CreatSign";
                        },
                        text: '<i class="bi bi-file-earmark-pdf">&nbsp; PDF</i>',
                        className: 'btn btn-sm btn-outline-danger',
                        footer: true,
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        },
                        customize: function ( doc ) {
                            doc.content.splice(0, 0, {
                                margin: [ 0, 0, 0, 0 ],
                                alignment: 'center',
                                image: 'data:image/jpeg;base64,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',
                                width: 50,
                                height: 50
                            } );
                        }
                    },
                    {
                        extend: 'excel',
                        title: function() {
                            return "Laporan Permintaan Barang CreatSign";
                        },
                        text: '<i class="bi bi-file-earmark-excel">&nbsp; Excel</i>',
                        className: 'btn btn-sm btn-outline-success',
                        footer: true,
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                    },
                ]
          });
        });
    </script>
@endpush
