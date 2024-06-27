<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Enroll;
use App\Models\Comment;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Collection;

class StudentController extends Controller
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
        return view('student.index');
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
        // this function  show the coursemates to student
        //$id is course it 
        return view('student.coursemates',['course_id'=>$id]);
        // $user_id = auth()->user()->id;
        // $users = User::whereHas('enrolls', function ($query) use ($user_id,$id) {
        //     $query->where('course_id', $id);
        //     $query->whereNot('user_id', $user_id);
        // })->get();
        // dd($users);
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
            // return DataTables::of(Course::all())->toJson();
            // return DataTables::of(Course::query())->toJson();
            $id = auth()->user()->id;
            $courses = Course::whereHas('enrolls', function ($query) use ($id) {
                $query->where('user_id', $id);
            })->with('user','enrolls')->get();
            
            return DataTables::of($courses)
            ->addColumn('image', function ($course) {
                return '<img src="'.$course->image.'" border="0" width="100" class="img-rounded" align="center" />';
            })
            // ->addColumn('actions','student.actions')//view
            ->addColumn('actions', function ($course) {
                return view('student.actions',['course'=>$course]);
            })
            ->rawColumns(['actions','image'])
            ->make(true);
        }
    }
    public function getCoursemates(Request $request,$id)
    {
        if($request->ajax())
        {
            $user_id = auth()->user()->id;
            $users = User::whereHas('enrolls', function ($query) use ($user_id,$id) {
              $query->where('course_id', $id);
              $query->whereNot('user_id', $user_id);
          });
          return DataTables::of($users)
          ->addColumn('profile',function($user){
            return '<img src="'.$user->profile.'" border="0" width="100" class="img-rounded" align="center" />';
          })
          ->rawColumns(['profile'])
          ->make(true);
        }
    }


}
