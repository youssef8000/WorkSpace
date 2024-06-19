@extends("frontend.layout.app")

@section("content")

<div class="project-form">
    <h2>Submit Your Project</h2>
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
    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image-upload">Upload Image:</label>
            <input type="file" id="image-upload" name="image" />
        </div>
        <div class="form-group">
            <label for="project-description">Title</label>
            <textarea id="project-description" name="title" required></textarea>
        </div>
        <div class="form-group">
            <label for="project-description">Project Description:</label>
            <textarea id="project-description" name="description" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="project-category">Project Category:</label>
            <select id="project-category" name="category">
                <option value="web-development">Web Development</option>
                <option value="graphic-design">Graphic Design</option>
                <option value="mobile-development">Mobile Development</option>
                <option value="digital-marketing">Digital Marketing</option>
            </select>
        </div>
        <button type="submit">Upload your project</button>
    </form>
</div>

@endsection
