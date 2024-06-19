<?php

namespace App\Http\Controllers;

use App\Models\AppliedJob;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreelancerController extends Controller
{
    public function findJob(Request $request)
    {
        $limit = $request->input('limit', 6);
        $projects = Project::where('creator_type', 'client')->take($limit)->get();
        return view('frontend.freelancer.find-job', compact('projects', 'limit'));
    }

    public function showFreelancers(Request $request)
{
    $limit = $request->input('limit', 6);
    $freelancers = User::where('type', 'freelancer')->take($limit)->get();
    return view('frontend.freelancer.find-freelancer', compact('freelancers', 'limit'));
}
    public function AddProduct()
    {
        return view('frontend.freelancer.add-project');
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

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);
        $user = Auth::user();
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $project = new Project();
        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->category = $request->input('category');
        $project->creator_id = $user->id;
        $project->creator_type = $user->type;
        $project->image = $imagePath;
        $project->save();

        return redirect()->back()->with('success', 'Project posted successfully!');
    }

    public function applyjobstore(Request $request)
    {

        $validatedData = $request->validate([
            'salary' => 'required|string|max:255',
            'job_id' => 'required',
        ]);


        $user = auth()->user();

        AppliedJob::create([
            'freelancer_id' => $user->id,
            'job_id' => $validatedData['job_id'],
            'salary' => $validatedData['salary'],
            'status'=>"pending",
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }

    public function viewProject($projectId)
    {
        $project = Project::findOrFail($projectId);
        $user = User::findOrFail($project->creator_id);
        $job_status = AppliedJob::where('job_id', $projectId)->get();
        $isAccepted = $job_status->contains('status', 'accepted');

        return view('frontend.freelancer.job-details', [
            'project' => $project,
            'user' => $user,
            'job_status' => $job_status,
            'isAccepted' => $isAccepted
        ]);
    }

public function viewFreelancer($id)
{
    $freelancer = User::findOrFail($id);
    $projects = Project::where('creator_id', $id)->get();
    return view('frontend.client.showFreelancer', ['freelancer' => $freelancer], ['projects' => $projects]);
}

}
