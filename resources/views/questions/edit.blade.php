@extends('layouts.lecturerSidebar')

@section('content')
    {!! Form::model($question, ['method' => 'PUT', 'route' => ['questions.update', $question->question_id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Question
        </div>

        <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 form-group">
                        {!! Form::label('exams', 'Exams', ['class' => 'control-label']) !!}
                        {!! Form::select('exams[]', $exams, old('exams') ? old('exams') : $question->exams->pluck('exam_id')->toArray(), ['class' => 'form-control select2']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('exams'))
                            <p class="help-block">
                                {{ $errors->first('exams') }}
                            </p>
                        @endif
                    </div>
                </div>
            <div class="row">
                <div class="form-group">
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
            <div class="row">
                <div class="form-group">
                    {!! Form::label('score', 'Score*', ['class' => 'control-label']) !!}
                    {!! Form::number('score', old('score'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('score'))
                        <p class="help-block">
                            {{ $errors->first('score') }}
                        </p>
                    @endif
                </div>
            </div>
          
        </div>
    </div>

    {!! Form::submit(trans('Update'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@stop

