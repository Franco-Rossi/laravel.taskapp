@extends('layouts.main')

@section('content')

<h1>{{ $project->title }}</h1>
<p>{{ $project->description }}</p>
<a name="" id="" class="mb-3" href="/projects/{{ $project->id }}/edit" role="">Edit</a>


@if ($project->tasks->count())

<div>
    @foreach ($project->tasks as $task)
    <div class="form-check">
        <form method="POST" action="/tasks/{{ $task->id }}">
            @method('PATCH')
            @csrf
            <label class="form-check-label" for="completed">
                <input type="checkbox" class="form-check-input" name="completed" id="" value="checkedValue" onChange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}>
                {{ $task->description }}
            </label>
        </form>
    </div>
    @endforeach
</div>

@endif


<div>
    <form method="POST" action="/projects/{{$project->id}}/tasks">
        @csrf
        <div class="form-group">
            <label for="description">New task</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Create</button>
    </form>

   @include('errors')
</div>



@endsection