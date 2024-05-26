@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row" style="height: 90vh;">
        <div class="col-3 card">
            <h3 class="text-center">Contacts</h3>
            <ul class="list-unstyled">
                @foreach ($users as $user)
                    <li class="mb-2 card">
                        <a class="btn btn-info btn-block" href="{{ route('chats.show', $user) }}" target="iframe">{{ $user->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-8">
            <iframe src="" name="iframe" frameborder="0" style="width: 100%; height: 100%;"></iframe>
        </div>
    </div>
</div>
@endsection
