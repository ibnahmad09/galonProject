<?php

namespace App\Http\Controllers;

use App\Models\StockMutation;
use Illuminate\Http\Request;
use App\Models\Product;

class StockMutationController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Riwayat Mutasi Stok
    public function index()
    {
        $mutations = StockMutation::with('product')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.stock.index', compact('mutations'));
    }

    // Tambah Stok Manual (Restock)
    public function restock(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::find($request->product_id);
        $product->stock += $request->quantity;
        $product->save();

        StockMutation::create([
            'product_id' => $product->id,
            'type' => 'in',
            'quantity' => $request->quantity,
            'description' => "Restock manual oleh admin"
        ]);

        return redirect()->back()->with('success', 'Stok berhasil ditambahkan');
    }
}