@extends('layouts.lecturerSidebar')

@section('content')
    <h3 class="page-title">Edit Options</h3>
    
    {!! Form::model($questions_option, ['method' => 'PUT', 'route' => ['questions_options.update', $questions_option->question_option_id]]) !!}

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class=" form-group">
                    {!! Form::label('question_id', 'Question', ['class' => 'control-label']) !!}
                    {!! Form::select('question_id', $questions, old('question_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('question_id'))
                        <p class="help-block">
                            {{ $errors->first('question_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    {!! Form::label('option_text', 'Option text*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('option_text', old('option_text'), ['class' => 'form-control ', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('option_text'))
                        <p class="help-block">
                            {{ $errors->first('option_text') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class=" form-group">
                    {!! Form::label('correct', 'Correct', ['class' => 'control-label']) !!}
                    {!! Form::hidden('correct', 0) !!}
                    {!! Form::checkbox('correct', 1, old('correct'), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('correct'))
                        <p class="help-block">
                            {{ $errors->first('correct') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('Update'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@stop

