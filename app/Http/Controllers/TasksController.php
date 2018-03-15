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
        $this->validFields($request);

        $arr = $request->all();
        $arr['file_name'] = $this->checkUploadFile('file',$request);
        $arr['genre'] = $this->arrayToString('genre', $request);
        
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
        $this->validFields($request, $id);

        $arr = $request->all();
        $file = $this->checkUploadFile('file',$request,$id);

        if(is_string($file)){
            $arr['file_name'] = $file;
        }else{
            $arr = $file;
        }

        $arr['genre'] = $this->arrayToString('genre', $request);
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

    public function checkUploadFile($file,$req,$id=null){
        if ($req->hasFile($file)) {
            $image = $req->file($file);
            $fileName = $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $fileName);
        }
            
        if($id || $req->hasFile($file)){
            return $fileName;
        }
        if($id && $req->hasFile($file)){
           return $fileName;
        }
        if($id && !($req->hasFile($file))){
            return $arr = $req->except('file_name');
        }

        
            return 'nofoto.jpg';
        
        
    }

    public function arrayToString($field, $req)
    {
        $arr = $req->only($field);
        $str = implode(',', $arr[$field]);
        return $str;
    }

    public function validFields($req, $id = '')
    {
        $this->validate($req, [
            'surname' => 'required|min:2|max:100',
            'name' => 'required|string|max:100|min:2',
            'email' => 'required|string|email|max:100|unique:tasks,email,' . $id,
            'phone' => 'required|digits:10|unique:tasks,phone,' . $id,
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
