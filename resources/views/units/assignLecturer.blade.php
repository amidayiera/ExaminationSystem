@extends ('layouts.adminSidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-lg-5">
            <div class="card">
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                <div class="card-header">Assign Lecturer</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/units/assignlecturer') }}" id="addLecturer">
                        @csrf
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="unit_id" class="col-md-4 col-form-label text-md-right">{{ __('Unit') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="unit_id" id="unit_id">
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id}}">{{$unit->unit_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lecturer_id" class="col-md-4 col-form-label text-md-right">{{ __('Lecturer') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="lecturer_id" id="lecturer_id">
                                    @foreach ($lecturers as $lecturer)
                                        <option value="{{ $lecturer->lecturer_id}}">{{$lecturer->first_name}}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection