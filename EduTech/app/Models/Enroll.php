<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Enroll;

class Enroll extends Model
{
    use HasFactory;
    // protected $fillable = ['user_id','course_id','progress','status','certificate','rating'];
    protected $guarded = [];

    public function getCertificateAttribute($value){
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/certificate_files/'.$value);
    }
    public function user(){
        return $this->belongsTO(User::class);
    }
    public function course(){
        return $this->belongsTO(Course::class);
    }
}
