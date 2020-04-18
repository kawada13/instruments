@extends('layouts.app')

@section('content')
<p>{!! link_to_route('user_profiles.show', $instrument->user->user_profile->name, ['id' => $instrument->user->user_profile->user_id]) !!}の楽器詳細</p>

<ul>
<p>機材名</p>
<li>{{ $instrument->instrument_name }}</li> 

<p>メーカー</p>
<li>{{ $instrument->maker }}</li> 

<p>種別</p>
<li>{{ $instrument->type }}</li> 

<p>価格</p>
<li>{{ $instrument->price }}</li> 

<p>機材コメント</p>
<li>{{ $instrument->comment }}</li> 

<img src="{!! Storage::disk('s3')->url($instrument->instrument_image) !!}">
    
</ul>

@if ($instrument->user_id == \Auth::user()->id)
{!! Form::open(['route' => 'instruments.image_upload', 'files' => true]) !!}
    {!! Form::file('instrument_image', $attributes = []) !!}
    {!! Form::submit('楽器画像アップロード') !!}
{!! Form::close() !!}

{!! Form::open(['route' => ['instruments.destroy', $instrument->user_id], 'method' => 'delete']) !!}
     {!! Form::submit('楽器詳細削除', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
 
 {!! link_to_route('instruments.edit', 'この機材プロフィールを編集', ['id' => $instrument->user_id], ['class' => 'btn btn-light']) !!}
 
@endif




{!! Form::open(['route' => 'comments.store']) !!}
 <div class="form-group">
{!! Form::label('comment', 'コメントする') !!}
{!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
{!! Form::hidden('instrument_id', $instrument->id) !!}
</div>
{!! Form::submit('コメント追加', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}



@if (count($instrument->comments) > 0)
       
@foreach ($instrument->comments as $comment)
        <p>{{ $comment->comment }}</p>
        
        
@if ($comment->user_id == \Auth::user()->id)
{!! Form::open(['route' => ['comments.destroy', $instrument->id], 'method' => 'delete']) !!}
     {!! Form::submit('コメント削除', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
@endif


@endforeach

@endif


@endsection