@extends ('layouts.studentSidebar')

@section('content')
<div id="content-header">
    {{-- <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Courses</a> </div> --}}
    <h2>Units</h2>
  </div>
 
  @section('sidebar')
  <p class="lead">{{ $lesson->course->title }}</p>

  <div class="list-group">
      @foreach ($lesson->course->publishedLessons as $list_lesson)
          <a href="{{ route('lessons.show', [$list_lesson->course_id, $list_lesson->slug]) }}" class="list-group-item"
              @if ($list_lesson->id == $lesson->id) style="font-weight: bold" @endif>{{ $loop->iteration }}. {{ $list_lesson->title }}</a>
      @endforeach
  </div>
@endsection

@section('main')

  <h2>{{ $lesson->title }}</h2>

      @if ($test_exists)
          <hr>
          <h3>Test: {{ $lesson->test->title }}</h3>
          @if (!is_null($test_result))
              <div class="alert alert-info">Your test score: {{ $test_result->test_result }}</div>
          @else
          <form action="{{ route('lessons.test', [$lesson->slug]) }}" method="post">
              {{ csrf_field() }}
              @foreach ($lesson->test->questions as $question)
                  <b>{{ $loop->iteration }}. {{ $question->question }}</b>
                  <br />
                  @foreach ($question->options as $option)
                      <input type="radio" name="questions[{{ $question->id }}]" value="{{ $option->id }}" /> {{ $option->option_text }}<br />
                  @endforeach
                  <br />
              @endforeach
              <input type="submit" value=" Submit results " />
          </form>
          @endif
          <hr />
      @endif
  @else
      Please <a href="{{ route('courses.show', [$lesson->course->slug]) }}">go back</a> and buy the course.
  @endif

  @if ($previous_lesson)
      <p><a href="{{ route('lessons.show', [$previous_lesson->course_id, $previous_lesson->slug]) }}"><< {{ $previous_lesson->title }}</a></p>
  @endif
  @if ($next_lesson)
      <p><a href="{{ route('lessons.show', [$next_lesson->course_id, $next_lesson->slug]) }}">{{ $next_lesson->title }} >></a></p>
  @endif

@endsection

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