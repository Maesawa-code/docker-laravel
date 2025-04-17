<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'weight' => $request->weight,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('home')->with('success', '商品を登録しました');
    }

    public function registerForm()
    {
        return view('products.register');
    }

    public function index()
    {
        $products = Product::whereNull('deleted_at')->get();
        return view('products.index', compact('products'));
    }
}
