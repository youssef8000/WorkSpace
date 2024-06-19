<?php

namespace App\Http\Controllers;

use App\Models\AppliedJob;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

class JobController extends Controller
{
    public function showForm()
    {
        return view('frontend.client.Post-job');
    }

    public function showByCategory($slug)
    {
        $projects = Project::where('category', $slug)
        ->where('creator_type', 'client')
        ->get();
       return view('frontend.freelancer.show_job_category', compact('projects'));
    }
    public function store(Request $request)
    {
        $user = auth()->user();
        $userPlan = $user->plan;
        $projectCount = Project::where('creator_id', $user->id)->count();

        if ($userPlan === 'free' && $projectCount >= 5) {
            return redirect()->back()->with('error', 'You have reached the limit of 5 projects for free plan users. Please go to your profile to change your plan.');
        }elseif($userPlan === 'plus' && $projectCount >= 10){
            return redirect()->back()->with('error', 'You have reached the limit of 10 projects for plus plan users. Please go to your profile to change your plan.');
        }

        $validatedData = $request->validate([
            'job_category' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string',
            'job_Responsibilities' => 'nullable|string',
            'needed_skills' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        Project::create([
            'creator_id' => $user->id,
            'creator_type' => $user->type,
            'category' => $validatedData['job_category'],
            'title' => $validatedData['job_title'],
            'description' => $validatedData['job_description'],
            'Responsibilities' => $validatedData['job_Responsibilities'],
            'needed_skills' => $validatedData['needed_skills'],
            'salary' => $validatedData['salary'],
            'image' => $validatedData['image'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Job posted successfully!');
    }

    public function portfolio()
    {
        $user = auth()->user();
        $projects = Project::where('creator_id', $user->id)->get();
        $freelancerAppliedJob=AppliedJob::where('freelancer_id', $user->id)->get();
        $Allprojects = Project::all();
        $users = User::all();
        $user_plan = $user->plan;
        return view('frontend.client.Profile', compact('projects'), compact('freelancerAppliedJob')
        , compact('Allprojects'), compact('users'), compact('user_plan'));
    }
    public function jobOffer($id)
    {
        $project = Project::findOrFail($id);
        $freelancerAppliedJobs = AppliedJob::where('job_id', $project->id)->get();
        $allProjects = Project::all();
        $users = User::all();
        return view('frontend.client.jobOffer', compact('project', 'freelancerAppliedJobs', 'allProjects', 'users'));
    }

    public function acceptApplication($id)
{
    $appliedJob = AppliedJob::findOrFail($id);
    $appliedJob->status = 'accepted';
    $appliedJob->save();

    return redirect()->back()->with('success', 'Application accepted successfully.');
}

public function rejectApplication($id)
{
    $appliedJob = AppliedJob::findOrFail($id);
    $appliedJob->status = 'rejected';
    $appliedJob->save();

    return redirect()->back()->with('success', 'Application rejected successfully.');
}

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if (auth()->user()->id !== $project->creator_id) {
            abort(403, 'Unauthorized action.');
        }

        $project->delete();

        return redirect()->route('Profile')->with('success', 'Project deleted successfully');
    }
}
