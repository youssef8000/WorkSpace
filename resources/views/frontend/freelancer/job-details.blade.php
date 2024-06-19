@extends("frontend.layout.app")

@section("content")

    <div class="job-description">
      <header>
        <div class="title">
          <h2>{{ $project->title }}</h2>
          <p>Salary: ${{$project->salary}}</p>
        </div>
        <p>Posted {{ $project->created_at->diffForHumans() }}</p>
      </header>
      <div class="content">
        <div class="requirements">
          <h3>Requirements:</h3>
          <ul>
            <li>{{$project->needed_skills}}</li>
          </ul>
        </div>
        <div class="responsibilities">
          <h3>Responsibilities:</h3>
          <ul>
            <li>{{$project->Responsibilities}}</li>
          </ul>
        </div>
        <div class="about-project">
          <h3>About Project:</h3>
          <p>{{ $project->description }}</p>
        </div>
        <div class="apply-buttons">
            @if(is_null($job_status) || $job_status->isEmpty())
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Apply
            </button>

        @else
        @if($isAccepted)
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalaccepted">
            Apply
        </button>
        @else
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Apply
            </button>
        @endif
        @endif
            <form action="{{ route('start_chat') }}" method="POST">
                @csrf
                <input type="hidden" name="receiveEmail" value="{{ $user->email }}">
                <button style="margin-top: 20px" type="submit"class="message-client-button">Message Client</button>
            </form>
        </div>
      </div>
    </div>




    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apply Job</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('applyJob.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                <label for="job_title">Price:</label>
                <input type="text" id="job_title" name="salary" required />
                <input type="text" id="job_title" name="job_id" value="{{$project->id}}" hidden />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
            </form>
        </div>

      </div>
    </div>
  </div>

  <!--Accepted Modal -->
<div class="modal fade" id="exampleModalaccepted" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            This job was taken by another freelancer.
          </h5>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Application Submitted</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Your application has been submitted successfully!</p>
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
