@extends('layouts.app')

@section('content')
    <h1>{{ $task->title }}</h1>

    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Due Date:</strong> {{ $task->due_date }}</p>
    <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>

    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Task List</a>
@endsection
