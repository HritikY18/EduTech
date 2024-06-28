<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB; 
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $course = Course::findOrFail($id);
        return view('student.comments',['course'=>$course]);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'course_id' => $id,
            'comment_text'=> $request->comment
          ]);
          return redirect(route('student.index'))->with('success','Comment added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }

    public function getComments(Request $request,$id){
        if($request->ajax())
        {
          $comments = Comment::with('user')->where('course_id',$id);
          return DataTables::of($comments)
          ->addColumn('profile',function($comment){
            return '<img src="'.$comment->user->profile.'" border="0" width="100" class="img-rounded" align="center" />';
          })
          ->rawColumns(['profile'])
          ->make(true);
        }

    }
}
