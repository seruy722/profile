@extends('layout')

@section('content')

<div class="container">
    <div class="left_side">
        <div class="photo">
            <img src="{{asset('images/'.$task->file_name)}}" alt="" height="200px" width="200px">
        </div>
        <input type="button" value="Добавить в друзья">
        <input type="button" value="Написать сообщение">       
    </div>
    <div class="right_side">
        <div class="fio"> {{$task->name}} {{$task->surname}}  </div>
        <div class="info">
            <table>
                <tr>
                    <td>Email:</td>
                    <td>{{$task->email}}</td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td>{{$task->phone}}</td>
                </tr>
                <tr>
                    <td>Номер банковской карты:</td>
                    <td>{{$task->card_of_bank}}</td>
                </tr>
                <tr>
                    <td>Комментарий:</td>
                    <td>{{$task->comment}}</td>
                </tr>
                <tr>
                        <td>Любимие жанры фильмов:</td>
                        <td>{{$task->genre}}</td>
                    </tr>
                    <tr>
                            <td>Пол:</td>
                            <td>{{$task->sex}}</td>
                        </tr>
                        <tr>
                                <td>День недели:</td>
                                <td>{{$task->day}}</td>
                            </tr>
            </table>
        </div>
    </div>
    <div class="link">
        <a href="{{route('tasks.edit',$task->id)}}">Редактировать</a>
        <a href="{{route('tasks.index')}}">На главную</a>
    </div>

</div>
@endsection