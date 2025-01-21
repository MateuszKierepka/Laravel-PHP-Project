<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses', compact('courses'));
    }

    public function manage()
    {
        $courses = Course::all();
        return view('admin.courses.manage', compact('courses'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());
        return redirect()->route('admin.courses')->with('success', 'Kurs "' . $course->title . '" zaktualizowany pomyślnie');
    }
}
