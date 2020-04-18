@extends('layouts.app')

@section('content')
    @if (Auth::check())
     @if (count($instruments) > 0)
        @include('instruments.instruments')
     @endif
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Musical Instruments</h1>
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection