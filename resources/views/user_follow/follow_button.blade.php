@if (Auth::id() != $user->user_profile->user_id)
    @if (Auth::user()->is_following($user->user_profile->user->id))
        {!! Form::open(['route' => ['user_profile.unfollow', $user->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfollow', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user_profile.follow', $user->id]]) !!}
            {!! Form::submit('Follow', ['class' => "btn btn-primary btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif