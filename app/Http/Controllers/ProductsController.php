<?php
namespace App\Http\Controllers;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price'=> 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'img/';
            $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $input['image'] = "$productImage";
        }
        Products::create($input);
        return redirect()->route('products.index')
            ->with('success','Product created successfully.');
    }

    public function show(Products $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Products $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Products $product)
    {
        $request->validate([
            'name',
            'detail',
            'price'

        ]);

        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'img/';
            $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $input['image'] = "$productImage";
        } else {
            unset($input['image']);
        }

        $product->update($input);
        return redirect()->route('products.index')
            ->with('success','Product updated successfully.');
    }

    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success','Product deleted successfully');
    }
    // API danh sách sản phẩm
    public function productListApi()
    {
        $products = Products::all();
        return response()->json(['products' => $products], 200);
    }

    // API cập nhật sản phẩm
    public function updateProductApi(Request $request, $id)
    {
        $product = Products::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required',
        ]);

         $input = $request->all();

        if ($request->hasFile('image')) {
            $destinationPath = 'img/';
            $productImage = date('YmdHis') . "." . $request->file('image')->getClientOriginalExtension();

            try {
                $request->file('image')->move($destinationPath, $productImage);
                $input['image'] = $productImage;
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to upload image'], 500);
            }
             } else {
                    unset($input['image']);
                }

        try {
            $product->update($input);
            return response()->json(['message' => 'Product updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update product'], 500);
        }
}

    // API xóa sản phẩm
    public function deleteProductApi($id)
    {
        $product = Products::find($id);
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
