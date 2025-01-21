<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Discount;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_column($cart, 'price'));

        return view('cart', compact('cart', 'total'));
    }

    public function add(Course $course)
    {
        $cart = session()->get('cart', []);
        $cart[$course->id] = [
            "title" => $course->title,
            "description" => $course->description,
            "price" => $course->price,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }

    public function remove(Course $course)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$course->id])) {
            unset($cart[$course->id]);
            session()->put('cart', $cart);
        }

        if (empty($cart)) {
            session()->forget('discount');
        }

        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        $cart = session('cart', []);
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + $item['price'];
        }, 0);

        $discount = session('discount');
        if ($discount) {
            $discountAmount = $discount->discount_amount;
            $totalAfterDiscount = $total - $discountAmount;
        } else {
            $discountAmount = 0;
            $totalAfterDiscount = $total;
        }

        return view('checkout', compact('total', 'discountAmount', 'totalAfterDiscount'));
    }

    public function applyDiscount(Request $request)
    {
        $code = $request->input('discount_code');
        $discount = Discount::where('code', $code)->first();

        if (!$discount) {
            return redirect()->back()->with('discount_error', 'Niepoprawny kod rabatowy.');
        }

        if (session('discount') && session('discount')->code == $code) {
            return redirect()->back()->with('discount_error', 'Kod rabatowy został już użyty.');
        }

        session(['discount' => $discount]);
        return redirect()->back();
    }

    public function applyDiscountAjax(Request $request)
    {
        $discountCode = $request->input('discount_code');
        $discount = Discount::where('code', $discountCode)->first();

        if ($discount) {
            session(['discount' => $discount]);
            $total = round($this->calculateTotal(), 2);
            $discountAmount = round($discount->discount_amount, 2);
            $newTotal = round($total - $discountAmount, 2);

            return response()->json([
                'success' => true,
                'total' => number_format($total, 2),
                'discountAmount' => number_format($discountAmount, 2),
                'newTotal' => number_format($newTotal, 2)
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Niepoprawny kod rabatowy.']);
        }
    }

    private function calculateTotal()
    {
        $cart = session()->get('cart', []);
        return array_sum(array_column($cart, 'price'));
    }
}
