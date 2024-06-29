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
            return view('teacher.uploadCertificateButton',['enroll'=>$enroll]);
        })
          ->rawColumns(['profile','image','uploadCertificateButton'])
          ->make(true);
    }

    public function store(Request $request)
    {
         if (request()->hasFile('certificate')) {
            $certificateFile = request()->file('certificate');
            $certificateFileName = $certificateFile->getClientOriginalName();
            $path = $certificateFile->store('public/certificate_files');
            $certificateFileName = basename($path);
            // dd($certificateFileName);
            $enroll = Enroll::findOrFail($request->enroll);
            $enroll->update(["certificate"=>$certificateFileName,"status"=>"accepted"]);
            return redirect(route('teacher.certificateRequests'))->with('success','Certificate uploaded successfully');
            // dd($request->enroll);
         }
    }
}

