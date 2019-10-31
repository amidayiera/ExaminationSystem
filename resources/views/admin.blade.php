{{-- @extends('layouts.auth') --}}
{{-- @extends('layouts.app') --}}
@extends('layouts.adminSidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-lg-5">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Admin is logged in
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
