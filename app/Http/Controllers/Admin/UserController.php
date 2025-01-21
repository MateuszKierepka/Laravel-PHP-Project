<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function removeCourse(User $user, Course $course)
    {
        $user->courses()->detach($course->id);
        return redirect()->route('admin.users')->with('success', 'Kurs został usunięty.');
    }
}
