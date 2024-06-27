<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Http\Requests\AddCourseRequest;
use App\Http\Requests\EditCourseRequest;
class CourseController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('teacher.courses');
        // return auth()->user()->courses()->get(); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.addCourse');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCourseRequest  $request)
    {
        $user_id = auth()->user()->id;
        if (request()->hasFile('image')) {
            $courseImage = request()->file('image');
            $courseImageName = $courseImage->getClientOriginalName();
            $path = $courseImage->store('public/course_images');
            $courseImageName = basename($path); 
        }
        
        $course =Course::create([
            'name'=> $request->name,
            'price' => $request->price,
            'image' => $courseImageName ,
            'user_id' => $user_id,
        ]);
        session()->flash('success','Course Added Successfully!');
        return redirect()->route('teacher.index');
        // return $request->user_id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('teacher.editCourse',['course'=>$course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCourseRequest $request, $id)
    {
        $course = Course::findOrFail($id);
        if ($request->hasFile('image'))
        {
            $profileImage = request()->file('image');
            $courseImageName = $profileImage->getClientOriginalName();
            $path = $profileImage->store('public/course_images');
            $courseImageName = basename($path);
            $course->name = $request->name;
            $course->price = $request->price;
            $course->image = $courseImageName;
        }
        else{
            $course->name = $request->name;
            $course->price = $request->price;
        }
        $course->save();
        session()->flash('success',"$request->name updates successfully!");
        return redirect()->route('teacher.index');
        // return view('teacher.index')->with('course-updated', 'User updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        session()->flash('danger',"$course->name course deleted!");
        $course->delete();
        return redirect()->route('teacher.index');
    }
}   
