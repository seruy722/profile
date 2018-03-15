@extends('layout')

@section('content')
@include('errors')

<form action="{{route('tasks.insert')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <fieldset>
        <legend>Информация о пользователе</legend>
        <label for="surname">Фамилия</label>
        <input type="text" name="surname" id="surname" value="{{ old('surname') }}">
        <label for="name">Имя</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="{{ old('email') }}">
        <label for="phone">Телефон</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone') }}">
        <label for="card_of_bank">Номер банковской карточки</label>
        <input type="text" name="card_of_bank" id="card_of_bank" value="{{ old('card_of_bank') }}">
        <label for="comment">Комментарий</label>
        <textarea name="comment" id="comment">{{ old('comment') }}</textarea>
        <fieldset>
            <legend>Любимие жанры фильмов</legend>
            <label for="action">Боевики</label>
        <input type="checkbox" name="genre[]" id="action" value="Боевики" {{(is_array(old('genre')) && in_array('Боевики',old('genre')))?'checked':''}}>
            <label for="comedy">Комедии</label>
            <input type="checkbox" name="genre[]" id="comedy" value="Комедии" {{(is_array(old('genre')) && in_array('Комедии',old('genre')))?'checked':''}}>
            <label for="adventure">Приключения</label>
            <input type="checkbox" name="genre[]" id="adventure" value="Приключения" {{(is_array(old('genre')) && in_array('Приключения',old('genre')))?'checked':''}}>
            <label for="historical">Исторические</label>
            <input type="checkbox" name="genre[]" id="historical" value="Исторические" {{(is_array(old('genre')) && in_array('Исторические',old('genre')))?'checked':''}}>
        </fieldset>
        <fieldset>
            <legend>Выбирите пол</legend>
            <label for="man">Мужской</label>
            <input type="radio" name="sex" id="man" value="Мужской" {{old('sex')=='Мужской'?'checked':''}}>
            <label for="women">Женский</label>
            <input type="radio" name="sex" id="women" value="Женский" {{old('sex')=='Женский'?'checked':''}}>
        </fieldset>
        <fieldset>
            <legend>Выбирите день недели</legend>
            <select name="day">
                <option value="">Не выбрано</option>
                <option value="Понедельник" {{old('day')=='Понедельник'?'selected':''}}>Понедельник</option>
                <option value="Вторник" {{old('day')=='Вторник'?'selected':''}}>Вторник</option>
                <option value="Среда" {{old('day')=='Среда'?'selected':''}}>Среда</option>
                <option value="Четверг" {{old('day')=='Четверг'?'selected':''}}>Четверг</option>
                <option value="Пятница" {{old('day')=='Пятница'?'selected':''}}>Пятница</option>
                <option value="Суббота" {{old('day')=='Суббота'?'selected':''}}>Суббота</option>
                <option value="Воскресенье" {{old('day')=='Воскресенье'?'selected':''}}>Воскресенье</option>
            </select>
        </fieldset>
    </fieldset>
    <input type="file" name="file">
    <input type="submit">
    <a href="{{route('tasks.index')}}">Отменить</a>
</form>
@endsection