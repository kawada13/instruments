@if (Auth::user()->is_favoriting($instrument->id))
        {!! Form::open(['route' => ['favorites.unfavorite', $instrument->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-outline-danger"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['favorites.favorite', $instrument->id]]) !!}
            {!! Form::submit('Favorite', ['class' => "btn btn-outline-primary"]) !!}
        {!! Form::close() !!}
    @endif