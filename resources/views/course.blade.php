@extends ('layouts.studentSidebar')

@section('content')
<div id="content-header">
    <h1 class="text-center text-uppercase">Courses</h1>
  </div>
  <div class="container-fluid">
    <hr><br>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
            @foreach ($courses as $course)
                <div class="container">
            <div class="card-deck">
                    <div class="card">
                      <div class="card-body">
                          <br>  
                      <a href="{{route('units.show', [$course->course_id])}}"><h3 class="card-title text-center">{{$course->course_name}}</h3></a>
                      <h5 class="card-details text-center">{{$course->course_code}}</h5>
                      </div>
                      <div class="text-center">
                        <small class="text-muted ">Created On: {{ date ('M j, Y', strtotime($course->created_at)) }}</small>
                      </div>
                    </div>
                    <br>
                  </div>
                </div>
                  <br>
            @endforeach

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