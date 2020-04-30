<!--楽器新規投稿画面-->

@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>楽器新規作成</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'instruments.store', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('instrument_name', '機材名') !!}
                    {!! Form::text('instrument_name', old('instrument_name'), ['class' => 'form-control']) !!}
                </div>            
            
            
                <div class="form-group">
                    {!! Form::label('type', '種別') !!}
                    {!! Form::text('type', old('type'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('maker', 'メーカー ') !!}
                    {!! Form::text('maker', old('maker'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('price', '価格') !!}
                    {!! Form::text('price', old('price'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('comment', '機材コメント') !!}
                    {!! Form::textarea('comment', old('comment'), ['class' => 'form-control']) !!}
                </div>


                {!! Form::submit('作成', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
