@extends ('layouts.lecturerSidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-lg-5">
            <div class="card">
                <div class="card-header">Edit Examination</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/exams/editexam/'. $examDetails->exam_id) }}" id="editExam">
                        @csrf
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="unit_id" class="col-md-4 col-form-label text-md-right">{{ __('Unit') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="unit_id" id="unit_id">
                                    @foreach ($unit as $oneunit)
                                        <option value="{{ $oneunit->unit_id}} ">{{$oneunit->unit_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="exam_title" class="col-md-4 col-form-label text-md-right">{{ __('Exam Title') }}</label>

                            <div class="col-md-6">
                            <input id="exam_title" type="text" name="exam_title" class="form-control" value="{{ $examDetails->exam_title}}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Change') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection