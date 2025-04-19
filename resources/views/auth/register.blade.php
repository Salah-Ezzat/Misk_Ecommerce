<x-guest-layout>
    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="text-danger">رقم الهاتف</label>
            <input type="text" name="phone" value="{{ old('phone') }}"
                class="form-control" placeholder="أدخل رقم الهاتف..." maxlength="11"
                pattern="^(010|011|012|015)[0-9]{8}$"
                title="رقم الهاتف يجب أن يبدأ بـ 010 أو 011 أو 012 أو 015 ويتكون من 11 رقم"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="text-danger">الرقم السري</label>
                <input type="password" name="password" class="form-control"
                    placeholder="كلمة المرور">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label class="text-danger">تأكيد الرقم السري</label>
                <input type="password" name="password_confirmation" class="form-control"
                    placeholder="تأكيد كلمة المرور">
            </div>
        </div>


        <div class="form-group">
            <label class="text-danger">اسم المحل</label>
            <input type="text" name="shop" value="{{ old('shop') }}"
                class="form-control" placeholder="اسم المحل...">
        </div>

        <div class="form-group">
            <label class="text-danger">اسم العميل</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="form-control" placeholder="اسم العميل...">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="text-danger">المحافظة</label>
                <select class="form-control" id="province" name="province">
                    <option value="">اختر المحافظة</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}"
                            {{ old('province') == $province->id ? 'selected' : '' }}>
                            {{ $province->province }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="text-danger">المدينة</label>
                <select class="form-control" id="city" name="city">
                    <option value="">اختر المدينة</option>
                    {{-- يتم تعبئتها ديناميكيًا بالـ JS حسب المحافظة --}}
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="text-danger">العنوان</label>
            <input type="text" name="address" value="{{ old('address') }}"
                class="form-control" placeholder="العنوان بالتفصيل...">
        </div>

        <div class="form-group">
            <label class="text-danger">نطاق التغطية</label>
            <div class="form-row">

                {{-- select 1 --}}
                <div class="form-group col-md-3">
                    <select class="form-control cover-select" id="cover_select_1"
                        name="cover[]">
                        <option value="">نطاق التغطية</option>
                        {{-- يتم تعبئته ديناميكيًا --}}
                    </select>
                </div>

                {{-- select 2 --}}
                <div class="form-group col-md-3">
                    <select class="form-control cover-select" id="cover_select_2"
                        name="cover[]">
                        <option value="">نطاق التغطية</option>
                        {{-- يتم تعبئته ديناميكيًا --}}
                    </select>
                </div>

                {{-- select 3 --}}
                <div class="form-group col-md-3">
                    <select class="form-control cover-select" id="cover_select_3"
                        name="cover[]">
                        <option value="">نطاق التغطية</option>
                        {{-- يتم تعبئته ديناميكيًا --}}
                    </select>
                </div>
                {{-- input يدوي --}}
                <div class="form-group col-md-3">
                    <input class="form-control" id="cover_input" name="cover[]"
                        placeholder="أضف مدينة أخرى يدويًا">
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="text-danger">تصنيف العميل</label>
            <select name="role_id" class="form-control">
                <option value="">اختر التصنيف</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}"
                        {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ $role->role }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="text-danger">تحميل صورة</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="text-danger">كود العميل</label>
                <input type="text" name="code" value="{{ old('code') }}"
                    class="form-control" placeholder="الكود...">
            </div>
            <div class="form-group col-md-6">
                <label class="text-danger">الحد الأدنى</label>
                <input type="number" name="min_limit" value="{{ old('min_limit') }}"
                    class="form-control" placeholder="الحد الأدنى...">
            </div>
        </div>
        <input type="hidden" name="confirm_add" value="1">
        <button type="submit" class="btn btn-success btn-block">إضافة</button>
    </form>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="phone" name="phone" :value="old('phone')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
