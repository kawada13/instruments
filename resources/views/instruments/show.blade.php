@extends('layouts.app')

@section('content')

<h1>{!! link_to_route('user_profiles.show', $instrument->user->user_profile->name, ['id' => $instrument->user->user_profile->user_id]) !!}の{{ $instrument->instrument_name }}詳細</h1>

<div class="card" style="width: 18rem;">
  <img src="{!! Storage::disk('s3')->url($instrument->instrument_image) !!}" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">機材名</h5>
    <p class="card-text">{{ $instrument->instrument_name }}</p>
  </div>
</div>


<table class="table table-bordered">
        <tr>
            <th>メーカー</th>
            <td>{{ $instrument->maker }}</td>
        </tr>
        <tr>
            <th>種別</th>
            <td>{{ $instrument->type }}</td>
        </tr>
        <tr>
            <th>価格</th>
            <td>{{ $instrument->price }}</td>
        </tr>
        <tr>
            <th>機材コメント</th>
            <td>{{ $instrument->comment }}</td>
        </tr>

</table>



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
<li class="list-group-item">
<div class="py-3 w-100 d-flex">
   <img src="{!! Storage::disk('s3')->url($comment->user->user_profile->profile_image) !!}" class="rounded-circle" width="50" height="50">
   <div class="ml-2 d-flex flex-column">
      <p class="mb-0">{{ $comment->user->user_profile->name }}</p>
   </div>
   <div class="d-flex justify-content-end flex-grow-1">
      <p class="mb-0 text-secondary">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
   </div>
</div>
<div class="py-3">
   {!! nl2br(e($comment->comment)) !!}
</div>
@if ($comment->user_id == \Auth::user()->id)
{!! Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'delete']) !!}
     {!! Form::submit('コメント削除', ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
@endif               
@endforeach
@endif


@endsection