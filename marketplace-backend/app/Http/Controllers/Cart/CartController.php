<?php

namespace App\Http\Controllers\Cart;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        if (!$user) {
            // Log or return an error if user is not authenticated
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $carts = Cart::where('user_id', $user->id)->with('product')->get();
        return response()->json($carts);
    }
    

    public function store(Request $request)
    {
        $cartItem = Cart::where('user_id', auth()->id())
                        ->where('product_id', $request->product_id)
                        ->first();
    
        if ($cartItem) {
            // Increment the quantity and ensure it doesn't go below 1
            $cartItem->quantity = max($cartItem->quantity + $request->quantity, 1);
            $cartItem->save();
        } else {
            // Create new item with a minimum quantity of 1
            $cartItem = Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => max($request->quantity, 1)
            ]);
        }
    
        return response()->json($cartItem, 201);
    }
    

    public function update(Request $request, $id)
    {
        $cart = Cart::where('user_id', auth()->id())->where('id', $id)->first();
        if (is_null($cart)) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
        $cart->update(['quantity' => $request->quantity]);
        return response()->json($cart);
    }
    

    public function destroy($id)
    {
        $cart = Cart::where('user_id', auth()->id())->where('id', $id)->first();
        if (is_null($cart)) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
        $cart->delete();
        return response()->json(['message' => 'Cart item removed']);
    }
}

