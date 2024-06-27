{{-- @if($id%2 ==1)
<a href="{{route('course.edit', $course->id)}}" class="btn btn-success btn-sm">Payment</a>
@else
<a href="{{route('course.edit', $course->id)}}" class="btn btn-primary btn-sm">Start</a>
@endif
<a href="{{route('student.show', $course->id)}}" class="btn btn-info btn-sm">Coursemates</a>
<a href="{{route('comment.create', $course->id)}}" class="btn btn-secondary btn-sm">Comment</a>
<a href="{{ route('teacher.enroll', $course->id) }}" class="btn btn-warning btn-sm">Rating</a> --}}

<?php
// $progress = $course->enrolls()->where('course_id',$course->id)->where('user_id',auth()->user()->id)->first()->progress;
$progress = $course->enrolls()->where('user_id',auth()->user()->id)->first()->progress;

$status = $course->enrolls()->where('user_id',auth()->user()->id)->first()->status;

$rating = $course->enrolls()->where('user_id',auth()->user()->id)->first();
if($rating)
{
    $rating = $rating->rating;
}

$payment_status = $course->payments()->where('user_id',auth()->user()->id)->first();
if($payment_status)
{
    $payment_status = $payment_status->payment_status;
}
?>

@if($payment_status=='approved' && $status=='accepted' )
<a href="{{route('student.index')}}" class="btn btn-primary btn-sm">Download</a>

@elseif($payment_status=='approved' && $status=='requested')
<a href="{{route('student.index')}}" class="btn btn-success btn-sm">Requested</a>

@elseif($payment_status=='approved' && $status=='completed')
<a href="{{route('student.index')}}" class="btn btn-success btn-sm">Certificate</a>

@elseif($payment_status=='approved' && $status=='incompleted')
<a href="{{route('student.index')}}" class="btn btn-success btn-sm">Start</a>

@elseif($payment_status == 'pending')
<a href="{{route('student.index')}}" class="btn btn-outline-warning">Wait</a>

@else
<a href="{{route('payment.create',$course)}}" class="btn btn-success btn-sm">Payment</a>
@endif


<a href="{{route('student.index')}}" class="btn btn-info btn-sm">Coursemates</a>
<a href="{{route('student.index')}}" class="btn btn-secondary btn-sm">Comment</a>

@if($payment_status=='approved' && $status=='accepted' && $rating == null)
<a href="{{route('student.index')}}" class="btn btn-warning btn-sm">Rating</a>
@elseif($payment_status=='approved' && $status=='accepted' && $rating)
<a class="btn btn-warning btn-sm">{{ $rating }}</a>
@endif