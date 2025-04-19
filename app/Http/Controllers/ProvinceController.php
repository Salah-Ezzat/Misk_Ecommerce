<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $provinces = Province::paginate(15);
        return view('backend.provinces.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.provinces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            
                'province' => 'required|unique:provinces|max:100|min:3',
            ],[

                'province.required' => 'يرجي إدخال اسم المحافظة',
                'province.unique' => 'اسم المحافظة مسجل مسبقاً',
            ]);
            Province::create([
                'province' => $request->province

            ]);
            session()->flash('Add', 'تم اضافة المحافظة بنجاح ');
            return redirect('provinces');

    }

    /**
     * Display the specified resource.
     */
    public function show(Province $province)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Province $province)
    {
       return view('backend.provinces.edit', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Province $province)
    {
        
        $id= $province->id;
        $this->validate($request,[
            'province' => 'required|max:100|min:3|unique:provinces,province,'.$id,
        ],[
            'province.required' => 'يرجي إدخال اسم المحافظة',
            'province.unique' => 'اسم المحافظة مسجل مسبقاً',
        ]);
        $province= Province::findOrFail($id);
        $province->update([

            'province'=>$request->province
        ]);
        session()->flash('edit','تم تعديل المحافظة بنجاج');
        return redirect('provinces');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $province = Province::findOrFail($id); 
        $province->delete(); 
    
        return redirect()->back()->with('delete', 'تم الحذف بنجاح');
    }
}
