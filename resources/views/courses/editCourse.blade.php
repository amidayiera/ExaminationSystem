@extends ('layouts.sidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-lg-5">
            <div class="card">
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                <div class="card-header">Edit Course</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/courses/editcourse/'. $courseDetails->course_id) }}" id="editCourse">
                        @csrf
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="course_name" class="col-md-4 col-form-label text-md-right">{{ __('Course Name') }}</label>

                            <div class="col-md-6">
                            <input id="course_name" type="text" name="course_name" class="form-control" value="{{ $courseDetails->course_name}}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="course_code" class="col-md-4 col-form-label text-md-right">{{ __('Course Code') }}</label>

                            <div class="col-md-6">
                                <input id="course_code" type="text" name="course_code" class="form-control" value="{{ $courseDetails->course_code}}" required autofocus>
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