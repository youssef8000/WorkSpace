@extends("frontend.layout.app")

@section("content")

<div class="job-description">
    <header>
        <div class="title">
            <h2>{{ $project->title }}</h2>
            <p>Salary: ${{ $project->salary }}</p>
        </div>
    </header>

    <div class="content">
        <h3>Applied Freelancers:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Freelancer Name</th>
                    <th scope="col">Applied Salary</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($freelancerAppliedJobs as $index => $appliedJob)
                    @php
                        $freelancer = $appliedJob->freelancer;
                    @endphp
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $freelancer->name }}</td>
                        <td>${{ $appliedJob->salary }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('view-freelancer', ['id' => $freelancer->id]) }}" class="btn btn-info" style="margin-right: 10px;">View Profile</a>

                                @if($appliedJob->status === 'pending')
                                    <!-- Accept Button -->
                                    <form action="{{ route('accept_application', ['id' => $appliedJob->id]) }}" method="POST" class="mr-2">
                                        @csrf
                                        <button type="submit" style="background-color: green;" class="btn btn-success">Accept</button>
                                    </form>

                                    <!-- Reject Button -->
                                    <form action="{{ route('reject_application', ['id' => $appliedJob->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" style="margin-left: 10px; background: red;" class="btn btn-danger">Reject</button>
                                    </form>
                                @else
                                    <span class="badge badge-info" style="margin-left: 10px; color: black; font-size: 20px">{{ ucfirst($appliedJob->status) }}</span>
                                @endif
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
