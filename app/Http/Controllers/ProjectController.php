<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
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
    public function index()
    {
        try {
            $projects = Project::where('status', '1')->where('owner_id', Auth::user()->id)->get();
            return view('projects.index', compact('projects'));
        } catch (\Exception $e) {
            return redirect()->route('projects.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
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
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
            ]);
            $project = new Project();
            $project->title  = $request->input('title');
            $project->description = $request->input('description');
            $project->owner_id = Auth::user()->id;
            $project->save();
            return redirect()->route('projects.index')->with('success', 'Project created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('projects.index')->with('error', $e->getMessage());
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
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::where('id', $id)->first();
        return view('projects.edit', compact('project'));
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
            // Validate the request data
            $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
            ]);
            $project = Project::find($id);
            $project->title = $request->get('title');
            $project->description = $request->get('description');
            $project->save();
            // Redirect to the project list with a success message
            return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('projects.index')->with('error', $e->getMessage());
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
            $project = Project::findOrFail($id);
            $project->delete();
            return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('projects.index')->with('error', $e->getMessage());
        }
    }
}
