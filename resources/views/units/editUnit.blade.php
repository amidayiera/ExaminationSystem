@extends ('layouts.adminSidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-lg-5">
            <div class="card">
                <div class="card-header">Edit Unit</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/units/editunit/'. $unitDetails->unit_id) }}" id="editUnit">
                        @csrf
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="course_id" class="col-md-4 col-form-label text-md-right">{{ __('Course') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="course_id" id="course_id">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->course_id}} ">{{$course->course_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="unit_name" class="col-md-4 col-form-label text-md-right">{{ __('Unit Name') }}</label>

                            <div class="col-md-6">
                            <input id="unit_name" type="text" name="unit_name" class="form-control" value="{{ $unitDetails->unit_name}}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="unit_code" class="col-md-4 col-form-label text-md-right">{{ __('Unit Code') }}</label>

                            <div class="col-md-6">
                                <input id="unit_code" type="text" name="unit_code" class="form-control" value="{{ $unitDetails->unit_code}}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lecturer_id" class="col-md-4 col-form-label text-md-right">{{ __('Lecturer') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="lecturer_id" id="lecturer_id">
                                    @foreach ($lecturers as $lecturer)
                                        <option value="{{ $lecturer->lecturer_id}}">{{$lecturer->first_name}} {{$lecturer->last_name}}</option>
                                    @endforeach
                                </select>
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