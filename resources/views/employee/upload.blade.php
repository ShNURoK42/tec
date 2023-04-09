@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="panel panel-primary">

        <div class="panel-heading mb-4">
            <h2>Загрузка работников</h2>
        </div>

        <div class="panel-body">
            <form method="POST" action="{{ route('employee.upload.store') }}" enctype="multipart/form-data">
                @csrf
                <input class="form-control @error('file') is-invalid @enderror" type="file" name="file"
                       id="employees_file">
                @error('file')
                <div id="employees_file" class="form-text text-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary mt-4">Загрузить</button>
            </form>
        </div>
    </div>
@endsection
