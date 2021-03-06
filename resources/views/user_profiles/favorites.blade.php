@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            @include('user_profiles.card', ['user' => $user])
        </aside>
        <div class="col-sm-8">
            @include('user_profiles.navtabs', ['user' => $user])
            @include('instruments.instruments', ['instruments' => $instruments])
        </div>
    </div>
@endsection