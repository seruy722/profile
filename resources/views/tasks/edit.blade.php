@extends('layout')

@section('content')
@include('errors')

<h3>Пользователь id - {{$task->id}}</h3>
<form action="{{route('tasks.update',$task->id)}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <fieldset>
            <legend>Информация о пользователе</legend>
        <label for="surname">Фамилия</label>
        <input type="text" name="surname" id="surname" value="{{ $task->surname }}">
        <label for="name">Имя</label>
        <input type="text" name="name" id="name" value="{{ $task->name }}">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="{{ $task->email }}">
        <label for="phone">Телефон</label>
        <input type="text" name="phone" id="phone" value="{{ $task->phone }}">
        <label for="card_of_bank">Номер банковской карточки</label>
        <input type="text" name="card_of_bank" id="card_of_bank" value="{{ $task->card_of_bank }}">
        <label for="comment">Комментарий</label>
        <textarea name="comment" id="comment">{{ $task->comment }}</textarea>
        <fieldset>
                <legend>Любимие жанры фильмов</legend>
                <label for="action">Боевики</label>
                <input type="checkbox" name="action" id="action" value="Боевики" {{stristr($task->genre, 'Боевики')?'checked':''}}>
                <label for="comedy">Комедии</label>
                <input type="checkbox" name="comedy" id="comedy" value="Комедии" {{stristr($task->genre, 'Комедии')?'checked':''}}>
                <label for="adventure">Приключения</label>
                <input type="checkbox" name="adventure" id="adventure" value="Приключения" {{stristr($task->genre, 'Приключения')?'checked':''}}>
                <label for="historical">Исторические</label>
                <input type="checkbox" name="historical" id="historical" value="Исторические" {{stristr($task->genre, 'Исторические')?'checked':''}}>
            </fieldset>
        <fieldset>
            <legend>Выбирите пол</legend>
        <label for="man">Мужской</label>
        <input type="radio" name="sex" id="man" value="Мужской" {{$task->sex=='Мужской'?'checked':''}}>
        <label for="women">Женский</label>
        <input type="radio" name="sex" id="women" value="Женский" {{$task->sex=='Женский'?'checked':''}}>
        </fieldset>
        <fieldset>
                <legend>Выбирите день недели</legend>
                    <select name="day">
                        <option value="">Не выбрано</option>
                        <option value="Понедельник" {{$task->day=='Понедельник'?'selected':''}}>Понедельник</option>
                        <option value="Вторник" {{$task->day=='Вторник'?'selected':''}}>Вторник</option>
                        <option value="Среда" {{$task->day=='Среда'?'selected':''}}>Среда</option>
                        <option value="Четверг" {{$task->day=='Четверг'?'selected':''}}>Четверг</option>
                        <option value="Пятница" {{$task->day=='Пятница'?'selected':''}}>Пятница</option>
                        <option value="Суббота" {{$task->day=='Суббота'?'selected':''}}>Суббота</option>
                        <option value="Воскресенье" {{$task->day=='Воскресенье'?'selected':''}}>Воскресенье</option>
                    </select>
            </fieldset>
    </fieldset>
        <input type="file" name="file">
        <input type="submit">
        <a href="{{route('tasks.index')}}">Отменить</a>
</form>
<img src="{{asset('images/'.$task->file_name)}}" alt="" height="200px" width="200px">
@endsection