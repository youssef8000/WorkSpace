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
            @foreach($chats as $chat)
            @if($chat->senderEmail == Auth::user()->email)

                    <h3 style="margin-bottom: 30px">
                        {{ $chat->receiver->name }}

                    </h3>

            @else

                    <h3 style="margin-bottom: 30px">
                        {{ $chat->sender->name }}
                    </h3>

            @endif
        @endforeach
            @foreach($messages as $message)
                @if($message->senderEmail == Auth::user()->email)
                    <div class="chat-message sent">
                        <p>{{ $message->message }}</p>
                    </div>
                @else
                    <div class="chat-message received">
                        <p>{{ $message->message }}</p>
                    </div>
                @endif
            @endforeach
        </div>
      <div class="input-container">
        <form action="{{ route('chats.store', ['email' => $chatWithUser->email]) }}" method="POST">
            @csrf
            <input type="text" name="message" class="chat-input" placeholder="Type your message..." required>
            <input type="text" name="chat_id" class="chat-input" placeholder="Type your message..." value="{{$chat->id}}" hidden required>
            <button type="submit" class="send-btn">Send</button>
        </form>
        <div class="vertical-line"></div>
      </div>
    </div>
  </div>
@endsection
