<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Image;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\StoreUserRequest;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'password' => $request->password,
            'phone' => $request->phone,
            'shop' => $request->shop,
            'province' => $request->province,
            'city' => $request->city,
            'address' => $request->address,


        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path('backend/assets/img/images'), $imageName);
            Image::create(['user_id' => $user->id, 'image' => $imageName]);
        }
        session()->flash('Add', 'تم إرسال البيانات بنجاح وفي انتظار موافقة الأدمن ');
        

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
