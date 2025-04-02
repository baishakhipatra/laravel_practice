<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ProjectController extends Controller
{
    public function projects()
    {
        $user = Auth::guard('user')->user();
        $query = Project::where('user_id', $user->id); 

        if (request()->has('keyword') && request('keyword') != '') {
            $keyword = request('keyword');

            $query->where(function($q) use ($keyword){
                $q->where('project_name', 'like', "%$keyword%")
                ->orWhere('project_details', 'like', "%$keyword%")
                ->orWhere('language_used', 'like', "%$keyword%")
                ->orWhere('team_members', 'like', "%$keyword%")
                ->orWhere('project_progress', 'like' ,"%$keyword%")
                ->orWhere('status', 'like' , "%$keyword%");
            });
        }
    
        $projects = $query->get(); 

        return view('additional_pages.projects', compact('projects'));
    }

    public function projectsAdd()
    {
        return view('additional_pages.projects_add');
    }

    public function projectsStore(Request $request)
    {

        //dd($request->all());
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_details' => 'required|string|max:255',
            'language_used' => 'required',
            'team_members' => 'numeric',
            'project_progress' => 'required|string|max:255',
            'status' => 'required|in:success,pending',
        ]);

        $user = Auth::guard('user')->user();

        if (!$user) {
            return redirect()->back()->withErrors('User not authenticated');
        }

        try {
            $project = Project::create([
                'user_id' => $user->id,  
                'project_name' => $request->project_name,
                'project_details' => $request->project_details,
                'language_used' => $request->language_used,
                'team_members' => $request->team_members,
                'project_progress' => $request->project_progress,
                'status' => $request->status,
            ]);
        
            if ($project) {
                return redirect()->route('projects')->with('success', 'Project added successfully.');
            }
        } catch (\Exception $e) {
            dd('Error:', $e->getMessage());
        }        
    }

    public function view_project($id)
    {
        $project = Project::where('id', $id)->first();

        if(!$project)
        {
            return redirect()->back()->with('error', 'projects not found');
        }

        return view('additional_pages.project_view', compact('project'));
    }

    public function project_delete($id)
    {
        $projects = Project::find($id);

        if (!$projects) {
            return redirect()->back()->with('error', 'Project not found');
        }

        try {
            $projects->delete();
            return redirect()->route('projects')->with('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting project: ' . $e->getMessage());
        }
    }

    public function projectEditForm($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }

       
        return view('additional_pages.project_edit_form', compact('project'));
    }

    public function projectUpdate(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_details' => 'required|string|max:255',
            'language_used' => 'required',
            'team_members' => 'numeric',
            'project_progress' => 'required|string|max:255',
            'status' => 'required|in:success,pending',
        ]);

        $project = Project::find($request->project_id);

        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }

        //dd($project);
        try {
            $project->update([
                'user_id' => $project->user_id,
                'project_name' => $request->project_name,
                'project_details' => $request->project_details,
                'language_used' => $request->language_used,
                'team_members' => $request->team_members,
                'project_progress' => $request->project_progress,
                'status' => $request->status,
            ]);

            return redirect()->route('projects')->with('success', 'Project updated successfully.');
        } catch (\Exception $e) {
            $e->getMessage();
            return redirect()->back()->with('error', 'Error updating project: ' . $e->getMessage());
        }
    }

}
