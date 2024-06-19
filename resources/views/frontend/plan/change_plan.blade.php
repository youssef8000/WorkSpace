@extends('auth.layout.app')

@section('content')

<style>
    .plans-container {
        display: flex;
        justify-content: center;
        margin: 10%;
        gap: 20px;
    }

    .plan {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 50px;
        width: 300px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .plan h2 {
        margin-bottom: 10px;
    }

    .price {
        font-size: 2em;
        margin-bottom: 20px;
    }

    .plan ul {
        list-style-type: none;
    }

    .plan li {
        background-color: #eee;
        padding: 10px;
        border-radius: 3px;
        margin-bottom: 20px;
    }

    .plan button {
        background-color: #007bff;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .plan button:hover {
        background-color: #0056b3;
    }
</style>

<div class="plans-container">
    <div class="container">
        <div class="row">
            <h1 style="color: #0056b3; font-size: 60px">My plan</h1>
            <hr>
            @if(Auth::user()->plan == 'free')
                <h2>Free Plan</h2>
            @elseif (Auth::user()->plan == 'plus')
                <h2>Plus Plan</h2>
            @else
                <h2>Pro Plan</h2>
            @endif
        </div>
    </div>

    <div class="plan">
        <h2>Free Plan</h2>
        <p class="price">$0/month</p>
        <ul>
            <li>Feature 1</li>
            <li>Feature 2</li>
            <li>Feature 3</li>
        </ul>
        <form method="POST" action="{{ route('update-plan') }}">
            @csrf
            <input type="hidden" name="plan" value="free">
            <button type="submit">Select</button>
        </form>
    </div>
    <div class="plan">
        <h2>Plus Plan</h2>
        <p class="price">$5/month</p>
        <ul>
            <li>Feature 1</li>
            <li>Feature 2</li>
            <li>Feature 3</li>
        </ul>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalPlus">
            Select
        </button>
    </div>
    <div class="plan">
        <h2>Pro Plan</h2>
        <p class="price">$13/month</p>
        <ul>
            <li>Feature 1</li>
            <li>Feature 2</li>
            <li>Feature 3</li>
        </ul>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalPro">
            Select
        </button>
    </div>
</div>

<!-- Modal Pro -->
<div class="modal fade" id="exampleModalPro" tabindex="-1" aria-labelledby="exampleModalProLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalProLabel">Payment Process</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="payment-info">
                    <form method="POST" action="{{ route('update-plan') }}" enctype="multipart/form-data">
                        @csrf
                        <input id="selected-plan" name="plan" value="pro" hidden>
                        <div class="form-section" style="margin-top: 20px">
                            <label for="card-number">Card Number:</label>
                            <input type="text" id="card-number" name="card-number" required />
                        </div>
                        <div class="form-section" style="margin-top: 20px">
                            <label for="cvv">CVV:</label>
                            <input type="text" id="cvv" name="cvv" required />
                        </div>
                        <div class="form-section" style="margin-top: 20px">
                            <label for="expiry-date">Expiry Date:</label>
                            <input type="month" id="expiry-date" name="expiry-date" required />
                        </div>
                        <button type="submit" style="margin-top: 20px">Submit Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Plus -->
<div class="modal fade" id="exampleModalPlus" tabindex="-1" aria-labelledby="exampleModalPlusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalPlusLabel">Payment Process</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="payment-info">
                    <form method="POST" action="{{ route('update-plan') }}" enctype="multipart/form-data">
                        @csrf
                        <input id="selected-plan" name="plan" value="plus" hidden>
                        <div class="form-section" style="margin-top: 20px">
                            <label for="card-number">Card Number:</label>
                            <input type="text" id="card-number" name="card-number" required />
                        </div>
                        <div class="form-section" style="margin-top: 20px">
                            <label for="cvv">CVV:</label>
                            <input type="text" id="cvv" name="cvv" required />
                        </div>
                        <div class="form-section" style="margin-top: 20px">
                            <label for="expiry-date">Expiry Date:</label>
                            <input type="month" id="expiry-date" name="expiry-date" required />
                        </div>
                        <button type="submit" style="margin-top: 20px">Submit Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
