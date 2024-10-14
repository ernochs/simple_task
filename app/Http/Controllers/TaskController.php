<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Project;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::all();
        // Filter tasks based on the selected project
        $tasks = Task::when($request->project_id, function ($query) use ($request) {
            return $query->where('project_id', $request->project_id);
        })->orderBy('position', 'asc')->get();

        return view('tasks', compact('tasks', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Log::info("starting task creation");
        // valiation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'priority' => 'required|integer|min:1|max:3',
            'project_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date'=> 'required|date|after_or_equal:start_date',
            //'project_id' => 'required|integer|exists:projects,id',
        ]);

        try {
            // Create task
            Task::create([
                'name' => $validatedData['name'],
                'priority' => $validatedData['priority'],
                'project_id' => $validatedData['project_id'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('tasks')->with('success', 'Task created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating task: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an error creating the task. Please try again.');
        }
    }

    public function edit(Request $request, $id)
{
    // Log the start of the task update process
    Log::info("Starting task update for task ID: {$id}");

    // Find the task by ID
    $task = Task::findOrFail($id);

    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'priority' => 'required|integer|min:1|max:3',
        'project_id' => 'required|integer',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'status' => 'required|string'
    ]);

    try {
        // Update task details
        $task->update([
            'name' => $validatedData['name'],
            'priority' => $validatedData['priority'],
            'project_id' => $validatedData['project_id'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
            'status' => $validatedData['status'],
        ]);

        // Redirect with success message
        return redirect()->route('tasks')->with('success', 'Task updated successfully!');
    } catch (\Exception $e) {
        // Log the error
        Log::error("Error updating task ID: {$id}, Error: " . $e->getMessage());

        // Redirect back with an error message
        return redirect()->back()->with('error', 'There was an error updating the task. Please try again.');
    }
}


    /**
     * Update the specified resource in storage.
     */
    public function updateOrder(Request $request)
    {
        $order = $request->order;

        foreach ($order as $item) {
            Task::where('id', $item['id'])->update(['position' => $item['position']]);
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete(); // Deletes the task

            return redirect()->route('tasks')->with('success', 'Task deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error deleting the task.');
        }
    }
}
