<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\EnrollRequest;

class EnrollController extends Controller
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
    public function store(EnrollRequest $request)
    {
        // dd($request->users);
        // dd($request->course_id);
        $course =Course::findOrFail($request->course_id);
        $data=[];
        foreach($request->users as $user)
        {
            $data[] = [
                'user_id' => $user,
                'course_id' =>$request->course_id,
            ];
        }
        // dd($data);
        $course->enrolls()->createMany($data);
        session()->flash('success','Students Enrolled Successfully!');
        return redirect()->route('teacher.index');
        // return view('teacher.index')->with('success','Students Enrolled Successfully!');
      
    }   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enroll  $enroll
     * @return \Illuminate\Http\Response
     */
    public function show(Enroll $enroll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enroll  $enroll
     * @return \Illuminate\Http\Response
     */
    public function edit(Enroll $enroll)
    {
        return view('student.startCourse',['enroll'=>$enroll]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enroll  $enroll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enroll $enroll)
    {
        if($request->progress == 100)
        {
            $enroll->update(['progress'=>$request->progress,'status'=>'completed']);
            return redirect(route('student.index'))->with('success',"Congratulations you have completed ".$enroll->course->name." course");
        }
        else{
            $enroll->update(['progress'=>$request->progress]);
            return redirect(route('student.index'))->with('success',"Course progress updated to $request->progress");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enroll  $enroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enroll $enroll)
    {
        //
    }
}
