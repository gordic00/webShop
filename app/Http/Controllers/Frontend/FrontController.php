<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$featured_products = Product::where('trending','1')->take(15)->get();
        $products = Product::all();
        $featured_products = ProductDetails::where('trending','1')->where('status','0')->take(15)->get();
        $trending_category = Category::where('popular','1')->where('status','0')->take(15)->get();
        return view('frontend.index', compact('featured_products','products','trending_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function category()
    {
        $category = Category::where('status','0')->get();
        return view('frontend.category', compact('category'));
    }

    public function viewcategory($slug)
    {
        if (Category::where('slug',$slug)->exists()) {
            $category = Category::where('slug',$slug)->first();
            if (Product::where('category_id',$category->id)->exists()) {
                $products = Product::where('category_id',$category->id)->get();
                //$productDetails = ProductDetails::where('product_id',$products[0]['id'])->where('status','0')->get();
                $productDetails = ProductDetails::where('status','0')->get();
                return view('frontend.products.index',compact('category','products','productDetails'));
            }
            return redirect('category')->with('status',"Nema proizvoda.");
        }else {
            return redirect('/')->with('status',"Kategorija ne postoji.");
        }   
    }

    public function prodactview($cate_slug, $prod_slug)
    {
        if (Category::where('slug',$cate_slug)->exists()) 
        {
            if (Product::where('slug', $prod_slug)->exists()) {
                $product = Product::where('slug', $prod_slug)->first();
                //$productDetails = ProductDetails::where('product_id',$products[0]['id'])->where('status','0')->get();
                //$productDetails = ProductDetails::where('status','0')->get();
                $productDetails = ProductDetails::where('product_id', $product->id)->first();

                return view('frontend.products.view', compact('product','productDetails'));
            }else {
                return redirect('/')->with('status','The link was broken!');
            }
        } else {
            return redirect('/')->with('status','No such category found!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
