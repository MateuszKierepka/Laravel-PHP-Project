<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCourse;

class UserCourseController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $courseIds = $request->input('course_ids', []);

        foreach ($courseIds as $courseId) {
            UserCourse::create([
                'user_id' => $user->id,
                'course_id' => $courseId,
            ]);
        }

        $request->session()->forget('cart');
        $request->session()->forget('discount');

        return redirect()->route('my-courses')->with('success', 'Kursy zostały zakupione.');
    }

    public function myCourses()
    {
        $purchasedCourses = UserCourse::with('course')->where('user_id', auth()->id())->get();
        return view('my-courses', compact('purchasedCourses'));
    }

    public function purchaseHistory()
    {
        $user = Auth::user();
        $purchaseHistory = UserCourse::where('user_id', $user->id)->with('course')->get();
        return view('purchase-history', compact('purchaseHistory'));
    }
}
