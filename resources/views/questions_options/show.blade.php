@extends('layouts.lecturerSidebar')

@section('content')
    <h3 class="page-title">Option</h3>

    <div class="panel panel-default">
      

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Question</th>
                            <td>{{ $questions_option->question}}</td>
                        </tr>
                        <tr>
                            <th width="20%">Option Text</th>
                            <td>{!! $questions_option->option_text !!}</td>
                        </tr>
                        <tr>
                            <th>Correct</th>
                            <td>{{ Form::checkbox("correct", 1, $questions_option->correct == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('questions_options.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
@stop