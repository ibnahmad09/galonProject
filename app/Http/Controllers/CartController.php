<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        $quantity = $request->input('quantity', 1);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);

        // Jika request via AJAX, return JSON
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Produk ditambahkan ke keranjang']);
        }

        // Jika request biasa, redirect
        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart');
        foreach ($request->quantities as $id => $quantity) {
            $cart[$id]['quantity'] = $quantity;
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Keranjang diperbarui');
    }

    public function cart()
    {
        $cartItems = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cartItems))->get();
        return view('customer.cart', compact('cartItems', 'products'));
    }
}
