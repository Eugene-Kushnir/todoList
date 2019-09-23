<?php

namespace App\Http\Controllers;

use App\Project;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::all();
        return view('list', compact('projects'));
    }

    public function create(request $request) {
        $project = new Project;
        $project->project = $request->text;
        $project-> save();

        return 'Done';
    }

    public function delete(Request $request)
    {
        Project::where('id', $request->id)->delete();
        return $request->all();
    }

    public function update(Request $request)
    {
        $project = Project::find($request->id);
        $project->project = $request->value;
        $project->save();
        return $request->all();
    }

}
