@inject('request', 'Illuminate\Http\Request')
@extends('layouts.lecturerSidebar')

@section('content')
    <h3 class="page-title">Questions</h3>
    @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif
    <p>
        <a href="{{ route('questions.create') }}" class="btn btn-primary">Create New Question</a>
        
    </p>
    <br>
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($questions) > 0 ? 'datatable' : '' }} @can('question_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        <th>Exam Title</th>
                        <th>Question</th>
                        <th  width="10%">Score</th>
                        <th>Created On</th>
                        <th>Action</th>
                       
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($questions) > 0)
                        @foreach ($questions as $question)
                            <tr data-entry-id="{{ $question->question_id }}">
                                <td>{{$question->exams->exam_title}}
                                <td>{!! $question->question !!}</td>
                                <td>{{ $question->score }}</td>
                                <td>{{ date ('M j, Y', strtotime($question->created_at)) }}</td>
                                <td>
                                        <a href="{{ route('questions.show',[$question->question_id]) }}" class="btn btn-sm btn-primary">View</a> &nbsp;&nbsp;
                                        <a href="{{ route('questions.edit',[$question->question_id]) }}" class="btn btn-sm btn-success">Edit</a>&nbsp;&nbsp;
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("Are you sure?")."');",
                                            'route' => ['questions.destroy', $question->question_id])) !!}
                                        {!! Form::submit(trans('Delete'), array('class' => 'btn btn-sm btn-danger')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
