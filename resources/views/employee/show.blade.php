@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h4>Работник: {{$employee->first_name}} {{$employee->last_name}}</h4>
    <h6>Статус:
        @if ($employee->is_working_now)
            <span class="text-success">Приступил к работе</span>
        @else
            <span class="text-muted">Не работает</span>
        @endif</h6>
    <hr>
    @if ($records->isEmpty())
        Нет записей
    @endif
    @foreach ($records as $year => $weeks)
        @foreach ($weeks as $week => $data)
            <div class="card mb-2">
                <div class="card-header">
                    {{$week}} неделя {{$year}} года
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Начало работы</th>
                            <th scope="col">Окончание работы</th>
                        </tr>
                        </thead>
                    @foreach ($data as $datum)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{date('d.m.Y H:i:s', strtotime($datum->started_work_at))}}</td>
                            <td>{{date('d.m.Y H:i:s', strtotime($datum->finished_work_at))}}</td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        @endforeach
    @endforeach
@endsection
