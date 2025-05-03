<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use App\Models\Image;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $users = User::with('image')->paginate(15);
        return view('backend.users.index', compact('users'));
    }

    public function wholesalers()
    {
        $city = Auth::user()->cityRelation->city;
        $users = User::where('role_id', 2)
            ->where('cover', 'like', '%' . $city . '%')
            ->with('image')->paginate(15);
        return view('frontend.traders.wholesalers', compact('users'));
    }

    public function traders()
    {
        $city = Auth::user()->cityRelation->city;
        $users = User::where('role_id', 3)
            ->where('cover', 'like', '%' . $city . '%')
            ->with('image')->paginate(15);
        return view('frontend.traders.traders', compact('users'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $provinces = Province::all();
        $cities = City::all();
        return view('backend.users.create', compact('roles', 'provinces', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $coverage = array_filter($request->cover); // يحذف العناصر الفارغة
        $coverage = array_unique($coverage); // يحذف العناصر المكررة
        $cover = implode(',', $coverage); // تحويل المصفوفة إلى سلسلة مفصولة بفواصل


        $user = User::create([
            'name' => $request->name,
            'password' => $request->password,
            'phone' => $request->phone,
            'shop' => $request->shop,
            'province' => $request->province,
            'city' => $request->city,
            'address' => $request->address,
            'cover' => $cover,
            'role_id' => $request->role_id,
            'code' => $request->code,
            'min_limit' => $request->min_limit,
            'confirm_add' => $request->confirm_add


        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path('backend/assets/img/images'), $imageName);
            Image::create(['user_id' => $user->id, 'image' => $imageName]);
        }
        session()->flash('Add', 'تم اضافة العميل بنجاح ');
        return redirect('users');
    }
    public function creatAccount(StoreUserRequest $request)
    {



        $user = User::create([
            'name' => $request->name,
            'password' => $request->password,
            'phone' => $request->phone,
            'shop' => $request->shop,
            'province' => $request->province,
            'city' => $request->city,
            'address' => $request->address,
            'role_id' => $request->role_id,


        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path('backend/assets/img/images'), $imageName);
            Image::create(['user_id' => $user->id, 'image' => $imageName]);
        }
        session()->flash('Add', 'تم إنشاء الحساب بنجاح وفي انتظار موافقة الأدمن ');
        return redirect('register');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // حفظ مسار الصفحة اللي كان فيها قبل ما يطلب تعديل
        session(['previous_url' => url()->previous()]);
        $user = User::findOrFail($id);
        $roles = Role::all();
        $provinces = Province::all();
        $cities = City::all();
        return view('backend.users.edit', compact('user', 'roles', 'provinces', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, string $id)
    {

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'shop' => $request->shop,
            'province' => $request->province,
            'city' => $request->city,
            'address' => $request->address,
            'role_id' => $request->role_id,
            'code' => $request->code,
            'min_limit' => $request->min_limit,
            'confirm_add' => $request->confirm_add


        ]);

        if ($request->filled('password')) {
            User::update(['password' => $request->password]);
        };
        if ($request->filled('cover')) {
            $coverage = array_filter($request->cover); // يحذف العناصر الفارغة
            $coverage = array_unique($coverage); // يحذف العناصر المكررة
            $cover = implode(',', $coverage); // تحويل المصفوفة إلى سلسلة مفصولة بفواصل
            $user->update(['cover' => $cover]);
        }



        if ($request->hasFile('image')) {
            if ($user->image) {
                $oldPath = public_path('backend/assets/img/images/' . $user->image->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath); // حذف الصورة من السيرفر
                }
                $user->image->delete(); // حذف من قاعدة البيانات
            }
            // نرفع الصور الجديدة
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path('backend/assets/img/images'), $imageName);

            // نحفظ الصور في الجدول

            Image::create(['user_id' => $user->id, 'image' => $imageName]);
        }
        session()->flash('edit', 'تم تعديل بيانات العميل بنجاح ');
        return redirect(session('previous_url', route('users.index')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // حذف الصور من السيرفر وقاعدة البيانات
        if ($user->image) {
            $image = $user->image;
            $imagePath = public_path('backend/assets/img/images/' . $image->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();
        }


        $user->delete();

        session()->flash('delete', 'تم حذف بيانات العميل وصوره بنجاح');

        return redirect()->back();
    }
    /**
     * Display a listing of the Add Requests need Confirmation.
     */

    public function confirm_add()
    {
        $users = User::where('confirm_add', 0)->with('image')->paginate(15);
        return view('backend.users.confirm_add', compact('users'));
    }
}
