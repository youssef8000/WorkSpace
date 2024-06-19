@extends("frontend.layout.app")

@section("content")

<!-- <div class="user-search">
    <div class="search-bar">
        <input type="text" placeholder="Search for jobs" />
    </div>
    <div class="job-listings">
        @foreach($projects as $project)
        <div class="job-listing">
            <header>{{ $project->title }}</header>
            <p>{{ $project->category }}</p>
            <p>{{ $project->needed_skills }}</p>
            <p>{{ $project->description }}</p>
            <p>{{ $project->salary }}</p>
            <form action="{{ route('view.project', ['projectId' => $project->id]) }}" method="GET" style="display: inline;">
                <button type="submit">Quick Apply</button>
            </form>
        </div>
        @endforeach
    </div> -->
    @if($projects->isEmpty())
    <h1 class="d-flex justify-content-center">No Jobs Found</h1>
    @else

<div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($projects as $project)
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center">{{ $project->title }}</h5>
                    <p class="card-text">Category: {{ $project->category }}</p>
                    <p class="card-text">Skills Needed: {{ $project->needed_skills }}</p>
                    <p class="card-text">Salary: ${{ $project->salary }}</p>
                    <form action="{{ route('view.project', ['projectId' => $project->id]) }}" method="GET" class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Quick Apply</button>
                    </form>
                    <div class="card-footer mt-2">
                        <small class="text-muted">Posted From {{ $project->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

</div>

@endsection
