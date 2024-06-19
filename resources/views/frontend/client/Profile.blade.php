@extends("frontend.layout.app")

@section("content")
<div class="portfolio">
    @auth
    @if(Auth::user()->type == 'client')
    <header>
        <h1>My Posted Jobs</h1>
    </header>
    @elseif(Auth::user()->type == 'freelancer')
    <header>
        <h1>My Portfolio</h1>
        <p>Welcome to my portfolio! Here you can find samples of my work.</p>
    </header>
    @endif

    <main>
        @if($projects->isEmpty())
        @if(Auth::user()->type == 'client')
        <p>You have no Jobs yet.</p>
        <form action="{{ route('post-job-form') }}" method="GET" class="d-flex justify-content-center">
            <button type="submit" class="post-project-btn">Post a Job</button>
        </form>
        @elseif(Auth::user()->type == 'freelancer')
        <p>You have no projects yet.</p>
        <form action="{{ route('add-project') }}" method="GET" class="d-flex justify-content-center">
            <button type="submit" class="post-project-btn">Post a Project</button>
        </form>
        @endif
        @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($projects as $project)
            <div class="col">
                <div class="card p-2 h-100">
                    @if(Auth::user()->type == 'client')
                    <h5 class="card-title d-flex justify-content-center">{{ $project->title }}</h5>
                        <p class="card-text">Description: {{ $project->description }}</p>
                        <p class="card-text">Responsibilities:{{ $project->Responsibilities }}</p>
                        <p class="card-text">Category:{{ $project->category }}</p>
                        <p class="card-text">Skills Needed: {{ $project->needed_skills }}</p>
                        <p class="card-text">Salary: ${{ $project->salary }}</p>
                        <a href="{{ route('jobOffer', ['id' => $project->id]) }}">
                            <button type="button">
                                View All Offers
                            </button>
                        </a>
                    @elseif(Auth::user()->type == 'freelancer')
                    <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top img-fluid custom-img-size" alt="{{ $project->title }}">
                    <h5 class="card-title d-flex justify-content-center">{{ $project->title }}</h5>
                    <p class="card-text">Description: {{ $project->description }}</p>
                    <p class="card-text">Category:{{ $project->category }}</p>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-flex justify-content-center" onsubmit="return confirm('Are you sure you want to delete this project?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                        <div class="card-footer mt-2">
                            <small class="text-muted">Posted {{ $project->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if(Auth::user()->type == 'client')
        <div class="d-flex justify-content-center mt-3">
            <form action="{{ route('post-job-form') }}" method="GET">
                <button type="submit" class="post-project-btn">Post a Job</button>
            </form>
        </div>
        @elseif(Auth::user()->type == 'freelancer')
        <div class="d-flex justify-content-center mt-3">
            <form action="{{ route('add-project') }}" method="GET">
                <button type="submit" class="post-project-btn">Upload a Project</button>
            </form>
        </div>
        @endif
        @endif

        @if(Auth::user()->type == 'freelancer')
        <h1 class="mt-3 d-flex justify-content-center">My Applied Jobs</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Client name</th>
                <th scope="col">job title</th>
                <th scope="col">salary</th>
                <th scope="col">status</th>
                <th scope="col">Message the client</th>
              </tr>
            </thead>
            <tbody>
                @foreach($freelancerAppliedJob as $index => $appliedJob)
                    @php
                        $client = $appliedJob->job->creator;
                        $job = $appliedJob->job;
                    @endphp
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $client->name }}</td>
                        <td>{{ $job->title }}</td>
                        <td>{{ $appliedJob->salary }}</td>
                        <td>{{ $appliedJob->status ?? 'Pending' }}</td>
                        <td>
                            <form action="{{ route('start_chat') }}" method="POST">
                                @csrf
                                <input type="hidden" name="receiveEmail" value="{{ $client->email }}">
                                <button type="submit" class="btn btn-primary">Start chat</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        @endif
    </main>
    @else
    <main>
        <p>Please <a href="{{ route('login') }}">log in</a> to view your projects.</p>
    </main>
    @endauth
</div>
<div class="container">
    <div class="row">
        <h1>My plan</h1>
        @if(Auth::user()->plan == 'free')
        <h2>Free Plan</h2>
      <ul>
        <li>Feature 1</li>
        <li>Feature 2</li>
        <li>Feature 3</li>
      </ul>
      @elseif (Auth::user()->plan =='plus')
      <h2>Plus Plan</h2>
      <ul>
        <li>Feature 1</li>
        <li>Feature 2</li>
        <li>Feature 3</li>
      </ul>
      @else
      <h2>Pro Plan</h2>
      <ul>
        <li>Feature 1</li>
        <li>Feature 2</li>
        <li>Feature 3</li>
      </ul>
      @endif
      <form action="{{ route('change-plan-form') }}" method="GET" class="d-flex justify-content-center mt-3">
        <button type="submit" class="btn btn-primary w-25">Change Plan</button>
    </form>
    </div>
</div>


  <!-- Success Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Plan Submitted</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Your Plan has been submitted successfully!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  @if(session('success'))
    <script>
      window.addEventListener('load', function() {
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
      });
    </script>
  @endif
@endsection
