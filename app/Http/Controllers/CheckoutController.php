<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;

class CheckoutController extends Controller
{
    public function selectPaymentMethod(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
        ]);

        session(['payment_method' => $request->payment_method]);

        return redirect()->route('checkout.index')->with('success', 'Metoda płatności została wybrana.');
    }

    public function clearDiscount(Request $request)
    {
        $request->session()->forget('discount');
        return response()->json(['status' => 'success']);
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
