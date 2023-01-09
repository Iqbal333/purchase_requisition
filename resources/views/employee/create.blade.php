@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">Create Employee
                <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('employee.index') }}">Employee</a>
                </span>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'employee.store', 'method'=>'POST')) !!}
                @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Username:</strong>
                                <input type="text" name="user_id" value="{{ Auth::user()->id }}" readonly placeholder="Username" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Division:</strong>
                                <select name="division_id" id="division" class="form-select choices" required>
                                    <option value="" selected hidden>--Choose Division--</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->id ?? '' }}">{{ $division->division_name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>NIK:</strong>
                                <input type="text" name="nik" value="" placeholder="NIK" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Position Name:</strong>
                                <input type="text" name="position_name" value="" placeholder="Nama Jabatan" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Employee Name:</strong>
                                <input type="text" name="employee_name" value="{{ Auth::user()->name }}" placeholder="Nama Karyawan" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                             <div class="form-group">
                                <strong>Phone Number:</strong>
                                <input type="text" name="phone_number" value="" placeholder="No Hp" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <strong>Address:</strong>
                        <textarea name="address" class="form-control" id="" cols="10" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
