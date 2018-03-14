<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests\createTaskRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;

class TasksController extends Controller {

    use ValidatesRequests;

    public function index() {

        $tasks = Task::all();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(createTaskRequest $request) {
        $genre = $request->only('action', 'comedy', 'adventure', 'historical');
        $array = array_diff($genre, ['']);
        $genre = implode(',', $array).' ';
        $arr = $request->except('action', 'comedy', 'adventure', 'historical');
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

    public function edit($id) {
        $myTask = Task::find($id);
        return view('tasks.edit', ['task' => $myTask]);
    }

    public function update(createTaskRequest $request, $id) {
        $genre = $request->only('action', 'comedy', 'adventure', 'historical');
        $array = array_diff($genre, ['']);
        $genre = implode(',', $array);
        $arr = $request->except('action', 'comedy', 'adventure', 'historical');
        $arr['genre'] = $genre;

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $fileName = $image->getClientOriginalName();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $fileName);
            $arr['file_name'] = $fileName;
        } else {
            $arr = $request->except('file_name');
        }

        $myTask = Task::find($id);
        $myTask->fill($arr);
        $myTask->save();
        return redirect()->route('tasks.index');
    }

    public function show($id) {
        $myTask = Task::find($id);
        return view('tasks.show', ['task' => $myTask]);
    }

    public function destroy($id) {
        Task::find($id)->delete();
        return redirect()->route('tasks.index');
    }

}
