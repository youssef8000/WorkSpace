@extends('auth.layout.app')

@section('content')
<div class="choose">
    <header>
        <h1>Join as a Client or Freelancer</h1>
        <p>Choose your role:</p>
    </header>
    <div class="options">
        <div class="option-box">
            <div class="option-client">
                <p>I am a client looking for freelancers</p>
                <input type="checkbox" id="client-check" class="checkmark" />
            </div>
        </div>
        <div class="option-box">
            <div class="option-freelancer">
                <p>I am a freelancer looking for projects</p>
                <input type="checkbox" id="freelancer-check" class="checkmark" />
            </div>
        </div>
    </div>
    <button id="create-account-btn">Create Account</button>
    <p class="done">Already Have An Account? <span class="abc"><u><a href="/login">sign in</a></u></span></p>
</div>

<script>
    document.getElementById('create-account-btn').addEventListener('click', function() {
        const isClientChecked = document.getElementById('client-check').checked;
        const isFreelancerChecked = document.getElementById('freelancer-check').checked;

        if (isClientChecked && !isFreelancerChecked) {
            window.location.href = "{{ route('registration_client_plan') }}";
        } else if (isFreelancerChecked && !isClientChecked) {
            window.location.href = "{{ route('registration_freelancer_plan') }}";
        } else {
            alert('Please select either Client or Freelancer.');
        }
    });
</script>
@endsection
