<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Mail\ProjectCreated;

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::where('owner_id', auth()->id())->get();
        
        return view ('projects.index', compact('projects'));
    }
    
    public function store()
    {

        $project = Project::create(request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:6']
        ]) + ['owner_id' => auth()->id()]);

            \Mail::to('francorossipriv@gmail.com')->send(
                new ProjectCreated($project)
            );


        
        return redirect('/projects');
    }
    
    public function create()
    {
        return view ('projects.create');
    }
    
    public function show(Project $project)
    {
        $this->authorize('update', $project);
        return view ('projects.show', compact('project'));
    }
    
    public function update(Project $project)
    {

        $project->update(request(['title', 'description']));

        return redirect('/projects');
        
    }
    
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('/projects');
        
    }
    
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
        
    }
    
}
