@extends('layout')

@section('content')
<a href="{{ route('tasks.create') }}">Создать</a>
<table>
    @foreach ($tasks as $task)
    <tr>
        <td>{{$task->id}}</td>
        <td>{{$task->surname}}</td>
        <td>{{$task->name}}</td>
        <td><a href="{{ route('tasks.show',$task->id) }}">Посмотреть</a></td>
        <td><a href="{{ route('tasks.edit',$task->id) }}">Редактировать</a></td>
        <td><a href="{{ route('tasks.destroy',$task->id) }}">Удалить</a></td>
    </tr>
    @endforeach
</table>

@endsection