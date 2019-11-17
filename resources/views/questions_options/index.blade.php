@inject('request', 'Illuminate\Http\Request')
@extends('layouts.lecturerSidebar')

@section('content')
    <h3 class="page-title">Options</h3>

    <div class="panel panel-default">
    
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($questions_options) > 0 ? 'datatable' : '' }} @can('questions_option_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        {{-- <th>Question</th> --}}
                        <th>Option Text</th>
                        <th width="10%">Correct</th>
                        <th width="20%">Action</th>
                      
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($questions_options) > 0)
                        @foreach ($questions_options as $questions_option)
                            <tr data-entry-id="{{ $questions_option->question_option_id }}">
                             
                                {{-- <td>{{!! $questions_option->question !!}}</td> --}}
                                <td>{!! $questions_option->option_text !!}</td>
                                <td>{{ Form::checkbox("correct", 1, $questions_option->correct == 1 ? true : false, ["disabled"]) }}</td>
                            
                                <td>
                                    <a href="{{ route('questions_options.show',[$questions_option->question_option_id]) }}" class="btn btn-sm btn-primary">View</a>&nbsp;&nbsp;
                                   
                                    <a href="{{ route('questions_options.edit',[$questions_option->question_option_id]) }}" class="btn btn-sm btn-success">Edit</a>&nbsp;&nbsp;
                                    
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
                            <td colspan="7">No entries in the table</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

