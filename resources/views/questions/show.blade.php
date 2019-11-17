@extends('layouts.lecturerSidebar')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Question</h2>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Question</th>
                            <td>{!! $question->question !!}</td>
                        </tr>
                        
                        <tr>
                            <th>Score</th>
                            <td>{{ $question->score }}</td>
                        </tr>
                    </table>
                </div>
            </div>

<table class="table table-bordered table-striped {{ count($questions_options) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th width=50%>Option</th>
            <th width="5%">Correct</th>
            <th>Action</th>
           
        </tr>
    </thead>

    <tbody>
        @if (count($questions_options) > 0)
            @foreach ($questions_options as $questions_option)
                <tr data-entry-id="{{ $questions_option->question_option_id }}">
                    {{-- <td>{{ $questions_option->question->question or '' }}</td> --}}
                                <td>{!! $questions_option->option_text !!}</td>
                                <td>{{ Form::checkbox("correct", 1, $questions_option->correct == 1 ? true : false, ["disabled"]) }}</td>
                               
                                <td>
                                    <a href="{{ route('questions_options.show',[$questions_option->question_option_id]) }}" class="btn btn-sm btn-primary">View</a>&nbsp;&nbsp;
                                   
                                    <a href="{{ route('questions_options.edit',[$questions_option->question_option_id]) }}" class="btn btn-sm btn-info">Edit</a>&nbsp;&nbsp;
                                 
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Are you sure?")."');",
                                        'route' => ['questions_options.destroy', $questions_option->question_option_id])) !!}
                                    {!! Form::submit(trans('Delete'), array('class' => 'btn btn-sm btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">No Entries in the Table</td>
            </tr>
        @endif
    </tbody>
</table>
{{-- </div>
</div> --}}
</div>

            <p>&nbsp;</p>

            <a href="{{ route('questions.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
@stop