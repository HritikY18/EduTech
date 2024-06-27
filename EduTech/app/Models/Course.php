<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class Course extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'price',
        'image',
        'user_id'
    ];
    protected $dates = ['deleted_at'];

    public function getImageAttribute($value)
    {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/course_images/'.$value);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrolls(){
        return $this->hasMany(Enroll::class);
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
