<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller {
    public function index(){ return Course::all(); }

    public function store(Request $req){
        $data = $req->validate([
            'title'=>'required|string',
            'description'=>'nullable|string',
            'teacher'=>'nullable|string',
        ]);
        $course = Course::create($data);
        return response()->json($course,201);
    }

    public function show($id){
        return Course::findOrFail($id);
    }

    public function update(Request $req, $id){
        $course = Course::findOrFail($id);
        $course->update($req->only(['title','description','teacher']));
        return response()->json($course);
    }

    public function destroy($id){
        Course::findOrFail($id)->delete();
        return response()->json(['message'=>'deleted']);
    }
}
