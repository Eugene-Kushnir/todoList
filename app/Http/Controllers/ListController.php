<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index() {
        $tasks = Task::all();
        return view('list', compact('tasks'));
    }

    public function create(request $request) {
        $task = new Task;
        $task->task = $request->text;
        $task-> save();

        return 'Done';
    }

    public function delete(Request $request)
    {
        Task::where('id', $request->id)->delete();
        return $request->all();
    }

    public function update(Request $request)
    {
        $task = Task::find($request->id);
        $task->task = $request->value;
        $task->save();
        return $request->all();
    }

    public function search(Request $request)
    {
//        $task = Task::find($request->id);
//        $task->task = $request->value;
//        $task->save();
        $term = $request->term;
        $tasks = Task::where('task','LIKE','%'.$term.'%')->get();
//        return $task;
        if (count($tasks) == 0) {
            $searchResult[] =  'No task found';
        } else {
            foreach ($tasks as $key=> $value) {
                $searchResult[] = $value->task;
            }
        }

        return $searchResult;
//        return $availableTags = [
//            "ActionScript",
//            "AppleScript",
//            "Asp",
//            "BASIC",
//            "C",
//            "C++",
//            "Clojure",
//            "COBOL",
//            "ColdFusion",
//            "Erlang",
//            "Fortran",
//            "Groovy",
//            "Haskell",
//            "Java",
//            "JavaScript",
//            "Lisp",
//            "Perl",
//            "PHP",
//            "Python",
//            "Ruby",
//            "Scala",
//            "Scheme"
//        ];
    }

}
