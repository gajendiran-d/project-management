<?php

namespace App\Http\Controllers;

use App\Events\TaskEvent;
use App\Models\Project;
use App\Models\Task;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectId)
    {
        try {
            $projects = $this->getProjects();
            $tasks = [];
            if ($projectId != 'null') {
                $tasks = Task::where('project_id', $projectId)->get();
            }
            return view('tasks.index', ['projects' => $projects, 'tasks' => $tasks, 'projectId' => $projectId]);
        } catch (\Exception $e) {
            return redirect()->route('tasks.index', 'null')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $projects = $this->getProjects();
            return view('tasks.create', compact('projects'));
        } catch (\Exception $e) {
            return redirect()->route('tasks.index', 'null')->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
            ]);
            $task = new Task;
            $task->project_id = $request->input('project');
            $task->title = $validatedData['title'];
            $task->description = $validatedData['description'];
            $task->creator_id = Auth::user()->id;
            $task->save();
            return redirect()->route('tasks.index', $task->project_id)->with('success', 'Task created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('tasks.index', 'null')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $task = Task::findOrFail($id);
            return view('tasks.edit', ['task' => $task]);
        } catch (\Exception $e) {
            return redirect()->route('tasks.index', 'null')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $projects = $this->getProjects();
            $task = Task::where('id', $id)->first();
            return view('tasks.edit', ['task' => $task, 'projects' => $projects]);
        } catch (\Exception $e) {
            return redirect()->route('tasks.index', 'null')->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable',
                'completed' => 'boolean',
            ]);

            $task = Task::findOrFail($id);
            $task->project_id = $request->input('project');
            $task->title = $validatedData['title'];
            $task->description = $validatedData['description'];
            $task->save();

            return redirect()->route('tasks.index', ['projectId' => $task->project_id])->with('success', 'Task updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('tasks.index', 'null')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return redirect()->route('tasks.index', 'null')->with('success', 'Task deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('tasks.index', 'null')->with('error', $e->getMessage());
        }
    }

    public function getProjects()
    {
        $getProjectId = TeamMember::where('user_id', Auth::user()->id)->where('role', 'admin')->pluck('project_id');
        $projects = Project::where('status', '1')->where('owner_id', Auth::user()->id)
            ->orWhere(function ($subquery)  use ($getProjectId) {
                $subquery->whereIn('id', $getProjectId->toArray());
            });
        $projects = $projects->get();
        return $projects;
    }

    public function assign()
    {
        try {
            $getProjectId = TeamMember::where('user_id', Auth::user()->id)->pluck('project_id');
            $projects = Project::with('tasks')->where('status', '1')->where('owner_id', Auth::user()->id)
                ->orWhere(function ($subquery)  use ($getProjectId) {
                    $subquery->whereIn('id', $getProjectId->toArray());
                });
            $projects = $projects->get();
            return view('tasks.assign', ['projects' => $projects]);
        } catch (\Exception $e) {
            return redirect()->route('tasks.assign')->with('error', $e->getMessage());
        }
    }

    public function status($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->is_completed = '1';
            $task->save();
            event(new TaskEvent($task->title. ' has been completed')); // Push Notification
            return redirect()->route('tasks.assign')->with('success', 'Task completed successfully!');
        } catch (\Exception $e) {
            return redirect()->route('tasks.assign')->with('error', $e->getMessage());
        }
    }
}
