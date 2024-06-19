@extends("frontend.layout.app")

@section("content")


<div class="freee-container">
    <input style="margin-top: 100px" type="text" class="search-input" placeholder="Search" />
    <div class="freelancers">
        @foreach($chats as $chat)
            @if($chat->senderEmail == Auth::user()->email)
                <div class="freelancer">
                    <a href="{{ route('chats.create', ['email' => $chat->receiver->email]) }}">
                        {{ $chat->receiver->name }}
                    </a>
                </div>
            @else
                <div class="freelancer">
                    <a href="{{ route('chats.create', ['email' => $chat->sender->email]) }}">
                        {{ $chat->sender->name }}
                    </a>
                </div>
            @endif
        @endforeach
    </div>
    <div class="chat-container">
        <div class="chat-box">
             <h1> Start Chating</h1>
        </div>
      <div class="input-container">

        <div class="vertical-line"></div>
      </div>
    </div>
  </div>
@endsection
