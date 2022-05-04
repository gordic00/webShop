<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.add');
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
        $category = new Category();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.'.$ext;
            $file->move('assets/uploads/category',$filename);
            $category->image = $filename;
        }

        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? '1' : '0';
        $category->popular = $request->input('popular') == TRUE ? '1' : '0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_descrip = $request->input('meta_descrip');
        $category->save();

        return redirect('categories')->with('status','Category Added Successfully');
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
    public function edit(Category $category)
    {
        //
        return view('admin.category.edit', [
            'category'=>$category
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
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'status' => ''
        ]);

        $category = Category::find($id);
        if ($request->hasFile('image')) {
            $path = 'assets/uploads/category/'.$category->image;
            if (File::exists($path)) {
                File::delete($path);

            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.'.$ext;
            $file->move('assets/uploads/category',$filename);
            $category->image = $filename;
        }
        $category->name = strip_tags($request->input('name'));
        $category->slug = strip_tags($request->input('slug'));
        $category->description = strip_tags($request->input('description'));
        $category->status = strip_tags($request->input('status') == TRUE ? '1' : '0');
        $category->popular = strip_tags($request->input('popular') == TRUE ? '1' : '0');
        $category->meta_title = strip_tags($request->input('meta_title'));
        $category->meta_keywords = strip_tags($request->input('meta_keywords'));
        $category->meta_descrip = strip_tags($request->input('meta_descrip'));

        $category->update();

        return redirect('categories')->with('status','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        if ($category->image) 
        {
            $path = 'assets/uploads/category/'.$category->image;
            if (File::exists($path)) 
            {
                File::delete($path);
            }
        }
        $category->delete();
        return redirect('categories')->with('status','Category Deleted Successfully');
    }
}
