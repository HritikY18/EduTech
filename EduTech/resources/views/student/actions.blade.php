<?php

$enroll =$course->enrolls()->where('user_id',auth()->user()->id)->first();

$payment_status = $course->payments()->where('user_id',auth()->user()->id)->orderBy('created_at','desc')->first();

if($payment_status)
{
    $payment_status = $payment_status->payment_status;
}
?>

@if($payment_status=='approved' && $enroll->status=='accepted' )
 <a href="{{ $enroll->certificate }}" class="btn btn-outline-primary"  download>download</a>

@elseif($payment_status=='approved' && $enroll->status=='requested')
<a href="{{route('student.index')}}" class="btn btn-outline-info">Requested</a>

@elseif($payment_status=='approved' && $enroll->status=='completed')
<a href="{{route('student.applyForCertificate',$enroll)}}" class="btn btn-outline-success">Certificate</a>

@elseif($payment_status=='approved' && $enroll->status=='incomplete')
<a href="{{route('enroll.edit',$enroll)}}" class="btn btn-primary btn-sm">Start</a>

@elseif($payment_status == 'pending')
<a href="{{route('student.index')}}" class="btn btn-outline-warning">Wait</a>

@else
<a href="{{route('payment.create',$course)}}" class="btn btn-success btn-sm">Payment</a>
@endif


<a href="{{route('student.show',$course->id)}}" class="btn btn-info btn-sm">Coursemates</a>
<a href="{{route('comment.create',$course->id)}}" class="btn btn-secondary btn-sm">Comment</a>

@if($payment_status=='approved' && $enroll->status=='accepted' && $enroll->rating == null)
<input type="submit" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop"   value="Rating" onclick="return buttonClick('{{$enroll->id}}')" >

@elseif($payment_status=='approved' && $enroll->status=='accepted' && $enroll->rating)
<a class="btn btn-warning btn-sm">{{$enroll->rating}}&#9734;
@endif