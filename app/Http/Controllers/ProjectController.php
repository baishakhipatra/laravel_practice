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

        if (!$user) {
            return redirect()->back()->withErrors('User not authenticated');
        }

        $projects = Project::where('user_id', $user->id)->get();

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
            'language_used' => 'required|array',
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

}
