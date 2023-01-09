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
            <div class="card-header">Employee
                @can('role-create')
                    <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('employee.create') }}">New Employee</a>
                    </span>
                @endcan
            </div>
            <div class="card-body">
                <table class="table table-hover" id="table1">
                    <thead class="thead-dark">
                        <tr>
                            <th>User Id</th>
                            <th>Employee Name</th>
                            <th>Division</th>
                            <th>Position Name</th>
                            <th>NIK</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $key => $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->employee_name }}</td>
                                <td>{{ $employee->division->division_name }}</td>
                                <th>{{ $employee->position_name }}</th>
                                <th>{{ $employee->nik }}</th>
                                <th>{{ $employee->phone_number }}</th>
                                <th>{{ $employee->address }}</th>
                                <td>
                                    <a class="btn btn-success" href="{{ route('employee.show',$employee->id) }}">Show</a>
                                    @can('post-edit')
                                        <a class="btn btn-primary" href="{{ route('employee.edit',$employee->id) }}">Edit</a>
                                    @endcan
                                    @can('post-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['employee.destroy', $employee->id],'style'=>'display:inline']) !!}
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
