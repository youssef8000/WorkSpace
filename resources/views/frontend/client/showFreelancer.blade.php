@extends("frontend.layout.app")

@section("content")

<div class="job-description">
    <h1>{{ $freelancer->name }}'s Profile</h1>
    <p><span>portfolio:</span> {{ $freelancer->portfolio }}</p>
    <p><span>skills:</span> {{ $freelancer->skills }}</p>

    @foreach ($projects as $project)
    <span style="font-size: 25px">{{ $loop->iteration }} </span>
    <li style="list-style: none;">
        <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top img-fluid custom-img-size" alt="{{ $project->title }}">
        <h2><span>Title:</span>{{ $project->title }}</h2>
        <h5><span>Category:</span>{{ $project->category }}</h5>
        <p><span>Description:</span>{{ $project->description }}</p>

    </li>
@endforeach
</div>

@endsection
