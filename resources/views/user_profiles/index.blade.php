@extends('layouts.app')

@section('content')
    @include('user_profiles.user_profiles', ['users' => $users])
@endsection