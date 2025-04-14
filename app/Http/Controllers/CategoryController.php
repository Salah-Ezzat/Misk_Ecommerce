<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::paginate(15);
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            
                'category' => 'required|unique:categories|max:100|min:3',
            ],[

                'category.required' => 'يرجي إدخال اسم القسم',
                'category.unique' => 'اسم القسم مسجل مسبقاً',
            ]);
            Category::create([
                'category' => $request->category

            ]);
            session()->flash('Add', 'تم اضافة القسم بنجاح ');
            return redirect('categories');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
       return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        
        $id= $category->id;
        $this->validate($request,[
            'category' => 'required|max:100|min:3|unique:categories,category,'.$id,
        ],[
            'category.required' => 'يرجي إدخال اسم القسم',
            'category.unique' => 'اسم القسم مسجل مسبقاً',
        ]);
        $category= Category::findOrFail($id);
        $category->update([

            'category'=>$request->category
        ]);
        session()->flash('edit','تم تعديل القسم بنجاج');
        return redirect('categories');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id); 
        $category->delete(); 
    
        return redirect()->back()->with('delete', 'تم الحذف بنجاح');
    }
}
