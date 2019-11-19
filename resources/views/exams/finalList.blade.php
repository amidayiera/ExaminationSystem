@extends('layouts.lecturerSidebar')

@section('content')
<div id="content-header">
    {{-- <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Courses</a> </div> --}}
    <h2>Exams</h2>
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

  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          {{-- <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Courses</h5>
          </div> --}}
          <div class="widget-content nopadding">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                    {{-- <th width="10%">Course Code</th>
                    <th>Coure Name</th> --}}
                  <th width="10%">Unit Code</th>
                  <th>Unit Name</th>
                  <th>Exam Title</th>
                  <th>Questions</th>
                  <th>Created on</th>
                  <th width="10%">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($exams as $exam)
                <tr class="gradeU">
                  <td>{{ $exam->unit->unit_code }}</td>
                  <td>{{ $exam->unit->unit_name }}</td>
                  <td>{{ $exam->exam_title}}</td>
                  <td>{{ count($exam->questions) }}</td>

                  <td>{{ date ('M j, Y', strtotime($exam->created_at)) }}</td>
                  {{-- <td>{{ $oneCourse-> }}</td> --}}
                  <td class="center"> <a href="{{ url('/exams/editexam/' .$exam->exam_id) }} " class="edit btn btn-primary btn-sm">Edit</a> 
                    <a id="deleteUnitButton" href="{{ url('/exams/deleteexam/' .$exam->exam_id) }}" onclick="return confirm('Are you sure you want to delete this exam?')" class="edit btn btn-danger btn-sm">Delete</a> </td>
                </tr> 
                {{--  --}}
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>

<script>
$(document).ready(function() {
    $('#example').DataTables();
} );

// $("deleteCourseButton").click(function(){
//   alert('test');
//   if(confirm("Are you sure you want to delete this course?")){
//     return true;
//   }
//   return false;
// });

</script>
@endsection