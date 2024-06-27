<a href="{{ route('teacher.enroll', $id) }}" class="btn btn-success btn-sm">Enroll</a>
<a href="{{route('course.edit', $id)}}" class="btn btn-primary btn-sm">Edit</a>
<a href="{{ route('course.destroy', $id) }}" class="btn btn-danger btn-sm"
    onclick="event.preventDefault(); document.getElementById('delete-course-{{ $id }}').submit();">Delete</a>
<form id="delete-course-{{ $id }}" action="{{ route('course.destroy', $id) }}" method="POST"
    style="display: none;">
    @csrf
    @method('DELETE')
</form>
<a href="{{route('teacher.show', $id)}}" class="btn btn-info btn-sm">Students</a>
<a href="{{route('teacher.comments', $id)}}" class="btn btn-secondary btn-sm">Comments</a>


