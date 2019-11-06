@extends('layouts.lecturerSidebar')

@section('content')
<div class="container">
    {{-- <h3 class="page-title">@lang('questions.title')</h3> --}}
    {{-- {!! Form::open(['method' => 'POST', 'route' => ['questions.store'], 'files' => true,]) !!} --}}
    {!! Form::open(['method' => 'POST','files' => true,]) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            {{-- @lang('app_create') --}}
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('question', 'Question*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('question', old('question'), ['class' => 'form-control ', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('question'))
                        <p class="help-block">
                            {{ $errors->first('question') }}
                        </p>
                    @endif
                </div>
            </div>
            {{-- <hr> --}}
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('score', 'Score*', ['class' => 'control-label']) !!}
                    {!! Form::number('score', old('score', 2), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('score'))
                        <p class="help-block">
                            {{ $errors->first('score') }}
                        </p>
                    @endif
                </div>
            </div>
            <hr>
            {{-- <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('tests', 'Tests', ['class' => 'control-label']) !!}
                    {!! Form::select('tests[]', $tests, old('tests'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('tests'))
                        <p class="help-block">
                            {{ $errors->first('tests') }}
                        </p>
                    @endif
                </div>
            </div> --}}
        </div>
    </div>
    
    @for ($question=1; $question<=4; $question++)
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-s-4 form-group">
                    {!! Form::label('option_text_' . $question, 'Option text*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('option_text_' . $question, old('option_text'), ['class' => 'form-control ', 'rows' => 3]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('option_text_' . $question))
                        <p class="help-block">
                            {{ $errors->first('option_text_' . $question) }}
                        </p>
                    @endif
                </div>
            </div>
            {{-- <hr> --}}
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('correct_' . $question, 'Correct', ['class' => 'control-label']) !!}
                    {!! Form::hidden('correct_' . $question, 0) !!}
                    {!! Form::checkbox('correct_' . $question, 1, false, []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('correct_' . $question))
                        <p class="help-block">
                            {{ $errors->first('correct_' . $question) }}
                        </p>
                    @endif
                </div>
            </div>
            <hr>
        </div>
    </div>
    @endfor

    {!! Form::submit(trans('Save'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
</div>
@stop

