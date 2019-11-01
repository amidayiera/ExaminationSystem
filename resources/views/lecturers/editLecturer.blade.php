@extends ('layouts.adminSidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-lg-5">
            <div class="card">
                <div class="card-header">Edit</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/lecturers/editlecturer/'. $lecturerDetails->id) }}" id="editLEcturer">
                        @csrf
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="course_id" class="col-md-4 col-form-label text-md-right">{{ __('Course') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="course_id" id="course_id">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->course_id}}">{{$course->course_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="course_id" class="col-md-4 col-form-label text-md-right">{{ __('Course') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="course_id" id="course_id">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->course_id}}">{{$course->course_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection