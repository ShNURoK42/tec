@extends('layouts.app')

@section('title', 'Список работников')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Имя</th>
            <th scope="col">Фамилия</th>
            <th scope="col">Статус</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($employees as $employee)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>
                    @if ($employee->is_working_now)
                        Приступил к работе
                    @else
                        Не работает
                    @endif
                </td>
                <td>
                    <a href="{{route('employee.show', $employee)}}">Отчет</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
