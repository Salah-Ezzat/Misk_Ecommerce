<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::with('category', 'images')->paginate(15);
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'product' => 'required|string|max:100|min:3',
            'cat_id' => 'required|exists:categories,id',
            'pack' => 'required',
            'images' => 'array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',

        ], [

            'product.required' => 'يرجي إدخال اسم المنتج',
            'cat_id.required' => 'يرجى اختيار القسم',
            'cat_id.exists' => 'القسم المختار غير موجود',
            'pack.required' => 'يرجي إدخال عبوة المنتج',
            'image.*.image' => 'الملف يجب أن يكون صورة صحيحة.',
            'image.*.mimes' => 'الصور يجب أن تكون من الأنواع التالية: jpeg, png, jpg, gif, svg, webp.',
            'image.*.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
        ]);
       $product= Product::create([
            'product' => $request->product,
            'cat_id' => $request->cat_id,
            'pack' => $request->pack,

        ]);

        if ($product->id){
        if ($request->hasFile('images')) {
            $storedImages = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('backend/assets/img/images'), $imageName);

                // الحفظ في قاعدة البيانات
                $storedImages[] = $imageName;
            }

            //  حفظها كلها دفعة واحدة في جدول
            foreach ($storedImages as $img) {
                Image::create(['pro_id' => $product->id, 'image' => $img]);
            }

        }
    }
        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return redirect('products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // حفظ مسار الصفحة اللي كان فيها قبل ما يطلب تعديل
        session(['previous_url' => url()->previous()]);
        $categories = Category::all();
        return view('backend.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'product' => 'required|string|max:100|min:3',
            'cat_id' => 'required|exists:categories,id',
            'pack' => 'required',
            'images' => 'array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
        ], [
            'product.required' => 'يرجي إدخال اسم المنتج',
            'cat_id.required' => 'يرجى اختيار القسم',
            'cat_id.exists' => 'القسم المختار غير موجود',
            'pack.required' => 'يرجي إدخال عبوة المنتج',
            'images.*.image' => 'الملف يجب أن يكون صورة صحيحة.',
            'images.*.mimes' => 'الصور يجب أن تكون من الأنواع التالية: jpeg, png, jpg, gif, svg, webp.',
            'images.*.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
        ]);
    
        // تحديث بيانات المنتج
        $product->update([
            'product' => $request->product,
            'cat_id' => $request->cat_id,
            'pack' => $request->pack,
        ]);
    
        // لو فيه صور جديدة
        if ($request->hasFile('images')) {
            // أولًا نحذف الصور القديمة
            foreach ($product->images as $oldImage) {
                $oldPath = public_path('backend/assets/img/images/' . $oldImage->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath); // حذف الصورة من السيرفر
                }
                $oldImage->delete(); // حذف من قاعدة البيانات
            }
    
            // نرفع الصور الجديدة
            $storedImages = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('backend/assets/img/images'), $imageName);
                $storedImages[] = $imageName;
            }
    
            // نحفظ الصور في الجدول
            foreach ($storedImages as $img) {
                Image::create(['pro_id' => $product->id, 'image' => $img]);
            }
        }
    
        session()->flash('edit', 'تم تعديل المنتج بنجاح   ');
        return redirect(session('previous_url', route('products.index')));
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // حذف الصور من السيرفر وقاعدة البيانات
        foreach ($product->images as $image) {
            $imagePath = public_path('backend/assets/img/images/' . $image->image);
    
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
    
            $image->delete();
        }
    
        // حذف المنتج
        $product->delete();
    
        session()->flash('delete', 'تم حذف المنتج وصوره بنجاح');
    
        return redirect()->back();
    }
}
