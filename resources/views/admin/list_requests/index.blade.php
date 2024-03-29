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
                <table class="table table-hover table-responsive" id="table1">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Request Number</th>
                            <th>Name</th>
                            <th>Division</th>
                            <th>Status</th>
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
                                <td>
                                    @if ($item->status == 'Approve')
                                        <span class="badge bg-primary">Approve</span>
                                    @elseif ($item->status == 'Reject')
                                        <span class="badge bg-danger">Reject</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                {{-- Ternary Javascript --}}
                                {{-- <td>{!! ($item['status']) === 'Approve' ? '<span class="badge bg-success">'.$item['status'].'</span>' : ((($item['status']) === 'Reject') ? '<span class="badge bg-danger">'.$item['status'].'</span>'  : '<span class="badge bg-warning">'.$item['status'].'</span>') !!}</td> --}}
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @can('request_items-show')
                                        <a class="btn btn-success" href="{{ route('list_request.show', $item->id) }}">Show</a>
                                    @endcan
                                    @can('request_items-edit')
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
