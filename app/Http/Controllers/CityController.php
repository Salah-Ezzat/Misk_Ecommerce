<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $cities = City::with('province')->paginate(15);
        return view('backend.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::all();
        return view('backend.cities.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'city' => 'required|string|max:100|min:3|unique:cities',
            'province_id' => 'required|exists:provinces,id',
          
        ], [

            'city.required' => 'يرجي إدخال اسم المدينة',
            'city.unique' => 'اسم المدينة مسجل مسبقاً',
            'province_id.required' => 'يرجى اختيار المحافظة',
            'province_id.exists' => 'المحافظة المختار غير موجود',
        
        ]);
        $city = City::create([
            'city' => $request->city,
            'province_id' => $request->province_id,


        ]);


        session()->flash('Add', 'تم اضافة المدينة بنجاح ');
        return redirect('cities');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        // حفظ مسار الصفحة اللي كان فيها قبل ما يطلب تعديل
        session(['previous_url' => url()->previous()]);
        $provinces = Province::all();
        return view('backend.cities.edit', compact('city', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        $id= $city->id;
        $this->validate($request, [
            'city' => 'required|string|max:100|min:3|unique:cities,city,'.$id,
            'province_id' => 'required|exists:provinces,id',
        ], [
            'city.required' => 'يرجي إدخال اسم المدينة',
            'city.unique' => 'اسم المدينة مسجل مسبقاً',
            'province_id.required' => 'يرجى اختيار المحافظة',
            'province_id.exists' => 'المحافظة المختار غير موجود',
           
        ]);

        // تحديث بيانات المدينة
        $city->update([
            'city' => $request->city,
            'province_id' => $request->province_id,
           
        ]);


        session()->flash('edit', 'تم تعديل المدينة بنجاح   ');
        return redirect(session('previous_url', route('cities.index')));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        session()->flash('delete', 'تم حذف المدينة بنجاح');

        return redirect()->back();
    }
}
