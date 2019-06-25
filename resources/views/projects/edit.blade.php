@extends('layouts.main')

@section('content')

<h1>Edit project</h1>

<form method="POST" action="/projects/{{ $project->id }}">
    @csrf
    @method('PATCH')
    
    <div>
        <label for="title">Project title</label>
        <input type="text" name="title" id="" class="form-control" placeholder="" value="{{ $project->title }}">
    </div>
    <div>
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="" rows="3" >{{ $project->description }}</textarea>
    </div>
    
    <button type="submit" class="btn btn-primary btn-block mb-1 mt-1">Update project</button>
</form>


<form method="POST" action="/projects/{{ $project->id }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-block">Delete</button>
</form>

@endsection