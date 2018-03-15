<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    use ValidatesRequests;

    public function index()
    {

        $tasks = Task::all();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $this->validCreate($request);

        $genre = $request->only('genre');
        $genre = implode(',', $genre['genre']);
        $arr = $request->all();
        $arr['genre'] = $genre;

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $fileName = $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $fileName);
            $arr['file_name'] = $fileName;
        } else {
            $arr['file_name'] = 'nofoto.jpg';
        }

        Task::create($arr);
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $myTask = Task::find($id);
        return view('tasks.edit', ['task' => $myTask]);
    }

    public function update(Request $request, $id)
    {
        $this->validUpdate($request,$id);

        $genre = $request->only('genre');
        $genre = implode(',', $genre['genre']);
        $arr = $request->all();
        $arr['genre'] = $genre;

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $fileName = $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $fileName);
            $arr['file_name'] = $fileName;
        } else {
            $arr = $request->except('file_name');
            $arr['genre'] = $genre;
        }

        $myTask = Task::find($id);
        $myTask->fill($arr);
        $myTask->save();
        return redirect()->route('tasks.index');
    }

    public function show($id)
    {
        $myTask = Task::find($id);
        return view('tasks.show', ['task' => $myTask]);
    }

    public function destroy($id)
    {
        Task::find($id)->delete();
        return redirect()->route('tasks.index');
    }

    public function validCreate($req)
    {
        $this->validate($req, [
            'surname' => 'required|min:2|max:100',
            'name' => 'required|string|max:100|min:2',
            'email' => 'required|string|email|max:100|unique:tasks',
            'phone' => 'required|digits:10|unique:tasks',
            'day' => 'required',
            'genre' => 'required',
            'comment' => 'required',
            'file' => 'image',
        ], [
            'surname.required' => 'Поле Фамилия незаполнено.',
            'surname.min' => 'Поле Фамилия не может быть меньше 2 символов.',
            'surname.max' => 'Поле Фамилия не может быть больше 100 символов.',
            'name.required' => 'Поле Имя незаполнено.',
            'name.max' => 'Поле Имя не может быть больше 100 символов.',
            'name.min' => 'Поле Имя не может быть меньше 2 символов.',
            'email.required' => 'Поле Email незаполнено.',
            'email.email' => 'Поле Email содержит невалидный адрес.',
            'email.max' => 'Поле Email не может быть больше 100 символов.',
            'email.unique' => 'Email адрес занят.',
            'phone.required' => 'Поле Телефон незаполнено.',
            'phone.digits' => 'Поле Телефон должно состоять из 10 цыфр.',
            'phone.unique' => 'Номер телефона занят.',
            'day.required' => 'Поле День недели незаполнено.',
            'genre.required' => 'Выберете минимум 1 жанр фильма.',
            'comment.required' => 'Поле комментарий незаполнено.',
            'file.image' => 'Файл должен быть изображением',
        ]);
    }

    public function validUpdate($req,$id)
    {
        $this->validate($req, [
            'surname' => 'required|min:2|max:100',
            'name' => 'required|string|max:100|min:2',
            'email' => 'required|string|email|max:100|unique:tasks,email,'.$id,
            'phone' => 'required|digits:10|unique:tasks,phone,'.$id,
            'comment' => 'nullable',
            'day' => 'required',
            'genre' => 'required',
            'file' => 'image',
        ], [
            'surname.required' => 'Поле Фамилия незаполнено.',
            'surname.min' => 'Поле Фамилия не может быть меньше 2 символов.',
            'surname.max' => 'Поле Фамилия не может быть больше 100 символов.',
            'name.required' => 'Поле Имя незаполнено.',
            'name.max' => 'Поле Имя не может быть больше 100 символов.',
            'name.min' => 'Поле Имя не может быть меньше 2 символов.',
            'email.required' => 'Поле Email незаполнено.',
            'email.email' => 'Поле Email содержит невалидный адрес.',
            'email.max' => 'Поле Email не может быть больше 100 символов.',
            'phone.required' => 'Поле Телефон незаполнено.',
            'phone.digits' => 'Поле Телефон должно состоять из 10 цыфр.',
            'day.required' => 'Поле День недели незаполнено.',
            'genre.required' => 'Выберете минимум 1 жанр фильма.',
            'comment.required' => 'Поле комментарий незаполнено.',
            'file.image' => 'Файл должен быть изображением',
            'phone.unique' => 'Номер телефона занят.',
            'email.unique' => 'Email адрес занят.',
        ]);
    }

}
