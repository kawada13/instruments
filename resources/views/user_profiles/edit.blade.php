<!--プロフィール編集画面-->

@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>{{ $user_profile->name }}のプロフィール編集</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::model($user_profile,  ['route' => ['user_profiles.update', $user_profile->user_id], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('gender', '性別') !!}
                    {!! Form::select('gender', ['男' => '男性', '女' => '女性'], ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('birth_place', '出身地') !!}
                    {!! Form::text('birth_place', old('birth_place'), ['class' => 'form-control']) !!}
                </div>

                
                
                <div class="form-group">
                    {!! Form::label('comment', '一言') !!}
                    {!! Form::text('comment', old('comment'), ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('登録', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
