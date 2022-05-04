<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        $productDetails = ProductDetails::all();
        return view('admin.product.index', compact('products', 'productDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Category::all();
        return view('admin.product.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //product insert
        $products = new Product();
        $products->category_id = $request->input('category_id');
        $products->name = $request->input('name');
        $products->slug = $request->input('slug');
        $products->small_description = $request->input('small_description');
        $products->description = $request->input('description');
        $products->save();
        
        //product details insert
        $productDetails = new ProductDetails();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.'.$ext;
            $file->move('assets/uploads/products',$filename);
            $productDetails->image = $filename;
        }

        $productDetails->product_id = $products->id;
        $productDetails->original_price = $request->input('original_price');
        $productDetails->selling_price = $request->input('selling_price');
        $productDetails->qty = $request->input('qty');
        $productDetails->size = $request->input('size');
        $productDetails->color = $request->input('color');
        $productDetails->status = $request->input('status') == TRUE ? '1' : '0';
        $productDetails->trending = $request->input('trending') == TRUE ? '1' : '0';
        $productDetails->meta_title = $request->input('meta_title');
        $productDetails->meta_keywords = $request->input('meta_keywords');
        $productDetails->meta_description = $request->input('meta_description');
        $productDetails->save();

        //redirect to product page
        return redirect('products')->with('status','Product Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        return view('admin.product.edit', [
            'products'=>$product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::find($id);
        
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->small_description = $request->input('small_description');
        $product->description = $request->input('description');
        $product->update();

        //product details update
        $productDetailsss = ProductDetails::find($product->productDetails[0]['id']);
        if ($request->hasFile('image')) {
            $path = 'assets/uploads/products/'.$productDetailsss->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.'.$ext;
            $file->move('assets/uploads/products',$filename);
            $productDetailsss->image = $filename;
        }

        $productDetailsss->original_price = $request->input('original_price');
        $productDetailsss->selling_price = $request->input('selling_price');
        $productDetailsss->qty = $request->input('qty');
        $productDetailsss->size = $request->input('size');
        $productDetailsss->color = $request->input('color');
        $productDetailsss->status = $request->input('status') == TRUE ? '1' : '0';
        $productDetailsss->trending = $request->input('trending') == TRUE ? '1' : '0';
        $productDetailsss->meta_title = $request->input('meta_title');
        $productDetailsss->meta_keywords = $request->input('meta_keywords');
        $productDetailsss->meta_description = $request->input('meta_description');
        $productDetailsss->update();

        return redirect('products')->with('status','Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        if ($product->productDetails[0]['image']) {
            $path = 'assets/uploads/products/'. $product->productDetails[0]['image'];
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $product->delete();

        return redirect('products')->with('status','Product Deleted Successfully');

    }
}
