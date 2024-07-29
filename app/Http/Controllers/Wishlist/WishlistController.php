<?php

namespace App\Http\Controllers\Wishlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', auth()->id())->get();
        return response()->json($wishlists);
    }

    public function store(Request $request)
    {
        $wishlist = Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
        ]);
        return response()->json($wishlist, 201);
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::where('user_id', auth()->id())->where('id', $id)->first();
        if (is_null($wishlist)) {
            return response()->json(['message' => 'Wishlist not found'], 404);
        }
        $wishlist->delete();
        return response()->json(['message' => 'Wishlist item removed']);
    }
}
