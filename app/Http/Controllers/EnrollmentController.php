<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Course;

class EnrollmentController extends Controller {
    public function store(Request $req, $courseId){
        $user = $req->user();
        $course = Course::findOrFail($courseId);

        // prevent double enroll
        $exists = Enrollment::where('user_id',$user->id)->where('course_id',$course->id)->exists();
        if($exists){
            return response()->json(['message'=>'Already enrolled'],409);
        }

        $enroll = Enrollment::create([
            'user_id'=>$user->id,
            'course_id'=>$course->id
        ]);
        return response()->json($enroll,201);
    }

    public function index(Request $req){
        // list enrollment user
        $user = $req->user();
        return $user->courses()->get();
    }
}
