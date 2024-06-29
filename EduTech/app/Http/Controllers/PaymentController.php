<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Course;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('student.payment',['course'=>$course]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request,$id)
    {
        Payment::create([
            'user_id'=>auth()->user()->id,
            'card_number'=>$request->card_number,
            'cvv'=>$request->cvv,
            'card_holder_name'=>$request->card_holder_name,
            'expiry_date'=>$request->expiry_date,
            'amount'=>$request->amount,
            'course_id'=>$id
        ]);
        return redirect(route('student.index'))->with('success','Payment Successfull!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $action = $request->query('action'); 
        if ($action === 'accept') {
            $payment->update(['payment_status'=>'approved']);
            return redirect(route('teacher.paymentRequests'))->with('success','Payment Request approved');
        } 
        elseif ($action === 'decline') {
            $payment->update(['payment_status'=>'declined']);
            return redirect(route('teacher.paymentRequests'))->with('danger','Payment Request declined');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
