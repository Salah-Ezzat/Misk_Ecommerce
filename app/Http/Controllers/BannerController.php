<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    public function index()
    {
        $banners = Banner::all();
        return view('backend.banners', compact('banners'));
    }
    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
        ], [

            'image.image' => 'الملف يجب أن يكون صورة صحيحة.',
            'image.mimes' => 'الصور يجب أن تكون من الأنواع التالية: jpeg, png, jpg, gif, svg, webp.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
        ]);


        $banner = Banner::findOrFail($id);
        $banner->update([
            'top_text'=>$request->top_text,
            'middle_text'=>$request->middle_text,
            'bottom_text'=>$request->bottom_text,

        ]);

        // رفع الصورة
        $imageName = time() . '.' . $request->new_image->extension();
        $request->new_image->move(public_path('backend/assets/img/banners'), $imageName);

        // حذف القديمة 
        if (file_exists(public_path('backend/assets/img/banners/' . $banner->img))) {
            unlink(public_path('backend/assets/img/banners/' . $banner->img));
        }

        $banner->img = $imageName;
        $banner->save();

        return redirect()->back()->with('success', 'تم تحديث الصورة بنجاح');
    }

}
