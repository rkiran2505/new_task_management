<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;



class TaskController extends Controller
{
    
    public function index(Request $request)
    {
        try {
            $tasks = Task::with(['user:id,name'])->orderBy('id', 'desc');
    
            if (Auth::user()->role !== 'admin') {
                $tasks->where('user_id', Auth::id());
            }
    
            if ($request->has('user_id')) {
                if (Auth::user()->role !== 'admin' && Auth::id() !== $request->user_id) {
                    return back()->with('error', 'You can only view your own tasks.');
                }
                $tasks->where('user_id', $request->user_id);
            }
    
            if ($request->has('status')) {
                $tasks->where('status', $request->status);
            }
    
            $tasks = $tasks->get();

            return view('tasks.index', compact('tasks'));
        } catch (Exception $e) {
            return back()->with('error', 'Error fetching tasks: ' . $e->getMessage());
        }
    }
    

    public function create()
    {
        return view('tasks.create');
    }
    // Store a new task
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'nullable|date|after:today',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->first(),
            ], 400);
        }

        try {
            $userId = Auth::user()->role === 'admin' ? $request->user_id : Auth::id();
            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'user_id' => $userId,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Task created successfully',
                'data' => $task
            ], 200);
        } catch (Exception $e) {
            return response()->json(['tasks.index' => false,'message' => 'Error creating task: ' . $e->getMessage(),], 400);
          
        }
    }

    // Show a specific task
    public function show(Task $task)
    {
        if ($task->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized access'], 403);
        }

        return response()->json(['success' => true, 'data' => $task], 200);
    }


    public function edit(Task $task)
{
    if ($task->user_id !== auth()->id()) {
        return redirect()->route('tasks.index')->with('error', 'You are not authorized to edit this task.');
    }
    return view('tasks.edit', compact('task'));
}
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            return redirect()->route('tasks.index')->with('error', 'You are not authorized to update this task.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed', // Adjust based on your status options
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->only('title', 'description', 'status', 'due_date'));
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    
    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
    
            if ($task->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
                return redirect()->route('tasks.index')->with('error', 'Unauthorized access');
            }
    
            $task->delete();
    
            return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
            
        } catch (Exception $e) {
            return redirect()->route('tasks.index')->with('error', 'Error deleting task: ' . $e->getMessage());
        }
    }
    
}