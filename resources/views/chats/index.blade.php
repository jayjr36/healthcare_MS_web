@extends('layout')

@section('content')
    <h1>Chats</h1>
    <ul>
        @foreach ($chats as $chat)
            <li>{{ $chat->message }}</li>
        @endforeach
    </ul>
@endsection
