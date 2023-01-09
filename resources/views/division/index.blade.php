@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header">Divisi
                @can('role-create')
                    <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('division.create') }}">New Division</a>
                    </span>
                @endcan
            </div>
            <div class="card-body">
                <table class="table table-hover" id="table1">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($divisions as $key => $division)
                            <tr>
                                <td>{{ $division->id }}</td>
                                <td>{{ $division->division_name }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('division.show',$division->id) }}">Show</a>
                                    @can('division-edit')
                                        <a class="btn btn-primary" href="{{ route('division.edit',$division->id) }}">Edit</a>
                                    @endcan
                                    @can('division-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['division.destroy', $division->id],'style'=>'display:inline']) !!}
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
