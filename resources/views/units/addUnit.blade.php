@extends ('layouts.adminSidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-lg-5">
            <div class="card">
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                <div class="card-header">Create New Unit</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/units/addunit') }}" id="addUnit">
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
                            <label for="unit_name" class="col-md-4 col-form-label text-md-right">{{ __('Unit Name') }}</label>

                            <div class="col-md-6">
                                <input id="unit_name" type="text" name="unit_name" class="form-control" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="unit_code" class="col-md-4 col-form-label text-md-right">{{ __('Unit Code') }}</label>

                            <div class="col-md-6">
                                <input id="unit_code" type="text" name="unit_code" class="form-control" required autofocus>
                            </div>
                        </div>
                       

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create New unit') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection