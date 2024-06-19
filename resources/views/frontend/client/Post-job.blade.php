@extends("frontend.layout.app")

@section("content")

<div class="post-job-container">
      <h2>Post a Job</h2>

    @if(session('success'))
        <div style="color: green; margin-top: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="color: red; margin-top: 20px;">
            {{ session('error') }}
        </div>
    @endif

      <form action="{{ route('store-job') }}" method="POST">
        @csrf
        <div style="margin-top: 20px">
            <label for="job_category">Job Category:</label>
            <select name="job_category" id="job_category" required>
                <option value="web-development">Web Development</option>
                <option value="graphic-design">Graphic Design</option>
                <option value="mobile-development">Mobile Development</option>
                <option value="digital-marketing">Digital Marketing</option>
            </select>
        </div>
        <div style="margin-top: 20px">
            <label for="job_title">Job Title:</label>
            <input type="text" id="job_title" name="job_title" required />
        </div>
        <div style="margin-top: 20px">
            <label for="job_description">Job Description:</label>
            <textarea id="job_description" name="job_description" required></textarea>
        </div>
        <div style="margin-top: 20px">
            <label for="job_description">Job Responsibilities:</label>
            <textarea id="job_description" name="job_Responsibilities" required></textarea>
        </div>
        <div style="margin-top: 20px">
            <label for="needed_skills">Needed Skills:</label>
            <input type="text" id="needed_skills" name="needed_skills" required />
        </div>
        <div style="margin-top: 20px">
            <label for="needed_skills">Salary:</label>
            <input type="text" id="salary" name="salary" required />
        </div>
        <button style="margin-top: 20px" type="submit">Post Job</button>
    </form>
    </div>

@endsection
