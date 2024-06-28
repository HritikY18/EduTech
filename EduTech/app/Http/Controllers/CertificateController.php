<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enroll;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB; 

class CertificateController extends Controller
{
    public function applyForCertificate(Enroll $enroll)
    {
        $enroll->update(['status'=>'requested']);
        return redirect(route('student.index'))->with('success','Applied for certificate');
    }

    public function certificateRequests(){
        return view('teacher.certificateRequests');
    }

    public function getCertificateRequests(){
        $enrolls = Enroll::whereHas('course',function($query) {
            $query->where('user_id',auth()->user()->id);
        })
        ->where('status','requested')
        ->with('course','user');

        return DataTables::of($enrolls)
        ->addColumn('profile',function($enroll){
            return '<img src="'.$enroll->user->profile.'" border="0" width="100" class="img-rounded" align="center" />';
          })
        ->addColumn('image',function($enroll){
            return '<img src="'.$enroll->course->image.'" border="0" width="100" class="img-rounded" align="center" />';
          })
          ->addColumn('uploadCertificateButton', function ($enroll) {
            return view('teacher.uploadCertificateButton',['payment'=>$enroll]);
        })
          ->rawColumns(['profile','image','uploadCertificateButton'])
          ->make(true);
    }
}
