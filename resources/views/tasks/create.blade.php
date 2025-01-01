@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Task</h2>
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="datetime-local" class="form-control" name="due_date" required>
        </div>
        <div class="form-group">
    <label for="status">Status</label>
    <select class="form-control" name="status" required>
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
        <option value="overdue">Overdue</option>
    </select>
</div>
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</div>
@endsection
