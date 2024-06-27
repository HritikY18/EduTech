<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\Enroll;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('teacher.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('teacher.courseStudents',['course_id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCourses(Request $request)
    {
        if($request->ajax())
        {
            $user_id = auth()->user()->id;
            $courses = Course::where('user_id',$user_id)->get();
            // $courses = auth()->user()->courses()->get();

            return DataTables::of($courses)
            ->addColumn('image', function ($course) {
                return '<img src="'.$course->image.'" border="0" width="80" height="80" class="img-rounded" align="center" />';
            })
            ->addColumn('actions','teacher.actions')//view
            ->rawColumns(['image', 'actions'])
            ->make(true);
        }
    }
    public function enroll($id)
    {
        $users = User::whereDoesntHave('enrolls', function ($query) use ($id) {
            $query->where('course_id', $id);
        })
        ->whereNot('role','teacher')->get();

        return view('teacher.enroll',['users'=>$users,'course_id'=>$id] );
    }

    public function getCourseStudents(Request $request,$id)
    {
        if($request->ajax())
        {
            $user_id = auth()->user()->id;
            $users = User::whereHas('enrolls', function ($query) use ($user_id,$id) {
              $query->where('course_id', $id);
          });
          return DataTables::of($users)
          ->addColumn('profile',function($user){
            return '<img src="'.$user->profile.'" border="0" width="100" class="img-rounded" align="center" />';
          })
          ->rawColumns(['profile'])
          ->make(true);
        }
    }
    

    public function comments($id)
    {
        $course = Course::findOrFail($id);
        return view('teacher.comments',['course'=>$course]);
    }
    
    public function paymentRequests(){
        return view('teacher.paymentRequests');
    }
   
    public function getPaymentRequest(){
        $user_id = auth()->user()->id;
        $payments = Payment::whereHas('course',function($query) use($user_id){
            $query->where('user_id',$user_id);
        })
        ->where('payment_status','pending')
        ->with('course','user')
        ->get();

        return DataTables::of($payments)
        ->addColumn('profile',function($payment){
            return '<img src="'.$payment->user->profile.'" border="0" width="100" class="img-rounded" align="center" />';
          })
        ->addColumn('image',function($payment){
            return '<img src="'.$payment->course->image.'" border="0" width="100" class="img-rounded" align="center" />';
          })
        //   ->addColumn('paymentRequestButtons','teacher.paymentRequestButtons')
          ->addColumn('paymentRequestButtons', function ($payment) {
            return view('teacher.paymentRequestButtons',['payment'=>$payment]);
        })
          ->rawColumns(['profile','image','paymentRequestButtons'])
          ->make(true);
    }

    public function temp(){
        $user_id = auth()->user()->id;
        $payments = Payment::whereHas('course',function($query) use($user_id){
            $query->where('user_id',$user_id);
        })
        ->with('course','user')
        ->get();
        
        foreach($payments as $payment)
        {
            dd($payment->user->profile);
        }
    }
}
