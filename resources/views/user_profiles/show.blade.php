@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            @include('user_profiles.card', ['user' => $user])
        </aside>
        <div class="col-sm-8">
            @include('user_profiles.navtabs', ['user' => $user])
        </div>
       
        
    </div>
    
    @if ($user->user_profile->user_id == \Auth::user()->id)
     {!! Form::open(['route' => 'user_profiles.image_upload', 'files' => true]) !!}
     {!! Form::file('profile_image', $attributes = []) !!}
     {!! Form::submit('プロフィール画像アップロード') !!}
     {!! Form::close() !!}
     {!! link_to_route('user_profiles.edit', 'このプロフィールを編集', ['id' => $user->user_profile->user_id], ['class' => 'btn btn-light']) !!}
    @endif
    
     @if (count($instruments) > 0)
          @include('instruments.instruments', ['instruments' => $instruments])
        @endif


@endsection