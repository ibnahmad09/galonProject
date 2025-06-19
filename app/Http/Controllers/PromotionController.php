<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    // Daftar Promosi
    public function index()
    {
        $promotions = Promotion::with('product')->get();
        return view('admin.promotions.index', compact('promotions'));
    }

    // Form Tambah Promosi
    public function create()
    {
        $products = Product::all();
        return view('admin.promotions.create', compact('products'));
    }

    // Simpan Promosi
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:promotions',
            'discount_percent' => 'required|numeric|min:1|max:99',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Promotion::create([
            'code' => $request->code,
            'discount_percent' => $request->discount_percent,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('admin.promotions')->with('success', 'Promosi berhasil ditambahkan');
    }

    // Hapus Promosi
    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();
        return redirect()->back()->with('success', 'Promosi dihapus');
    }
}