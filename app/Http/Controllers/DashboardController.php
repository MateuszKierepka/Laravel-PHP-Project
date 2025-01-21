<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCourse;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $purchaseHistory = UserCourse::where('user_id', $user->id)->with('course')->get();
        return view('dashboard', compact('purchaseHistory'));
    }
}
