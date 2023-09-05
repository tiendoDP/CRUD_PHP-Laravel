<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index(Request $request) {
        $keyWord = $request->search;

        if(!empty($keyWord)) {
            $products = Product::Where('name', 'LIKE', '%'.$keyWord.'%')->get();
        }
        else $products = Product::orderBy('created_at', 'asc')->get();
        return view('products.index', ['products' => $products]);
    }

    public function show() {
        //return view('products.index');
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2080',
        ], [
            'required' => ':attribute bắt buộc',
            'max' => ':attribute không được quá max:2080',
        ], [
            'name' => 'Tên sản phẩm',
            'image' => 'Hình ảnh'
        ]);
        $product = new Product();

        $file_name = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);
        

        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $file_name;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;

        $product->Save();
        return redirect()->route('products.index')->with('success', "Successfully");
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required'
        ]);

        $file_name = $request->hidden_product_image;

        if($request->image != '') {
            $file_name = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $file_name);
        }

        $product = Product::find($request->hidden_id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $file_name;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;

        $product->Save();

        return redirect()->route('products.index')->with('success', "Updated product");
    }

    public function destroy($id) {
        $product = Product::findOrFail($id);

        $image_path = public_path().'/images/';
        $image = $image_path.$product->image;
        if(file_exists($image)){
            @unlink($image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', "deleted product");
    }

}
