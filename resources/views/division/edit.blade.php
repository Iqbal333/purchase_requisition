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
            <div class="card-header">Edit Division
                <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('division.index') }}">Kembali</a>
                </span>
            </div>
            <div class="card-body">
                {!! Form::model($division, ['route' => ['division.update', $division->id], 'method'=>'PATCH']) !!}
                    <div class="form-group">
                        <strong>Nama Divisi:</strong>
                        {!! Form::text('division_name', null, array('placeholder' => 'Nama Divisi','class' => 'form-control')) !!}
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
