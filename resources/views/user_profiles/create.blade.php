<!--プロフィール新規作成画面だよー-->

@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>プロフィール新規作成</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::model($user_profile,  ['route' => 'user_profiles.store']) !!}
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
                    {!! Form::textarea('comment', old('comment'), ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('登録', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
