<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'product_name' => $request->product_name,
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

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image_path = $imagePath;
        }

        $product->product_name = $request->product_name;
        $product->weight = $request->weight;
        $product->save();

        return redirect()->route('products.show', $product->id)->with('success', '商品を更新しました！');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect()->route('products.index')->with('success', '商品を削除しました！');
    }
    
    
    
}
