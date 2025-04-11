<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('رقم الهاتف :')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" autofocus
                required />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('الرقم السري')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('تأكيد الرقم السري')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <!-- Shop -->
        <div class="mt-4">
            <x-input-label for="shop" :value="__('اسم المحل')" />
            <x-text-input id="shop" class="block mt-1 w-full" type="text" name="shop" :value="old('shop')"
                required />
            <x-input-error :messages="$errors->get('shop')" class="mt-2" />
        </div>
        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('اسم العميل')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Province -->
        <div class="mt-4">
            <x-input-label for="province" :value="__('المحافظة')" />
            <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province')"
                required autocomplete="province" />
            <x-input-error :messages="$errors->get('province')" class="mt-2" />
        </div>
        <!-- City -->
        <div class="mt-4">
            <x-input-label for="city" :value="__('المدينة')" />
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')"
                required autocomplete="city" />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>
        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('العنوان')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                required autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>
        <!-- Cover -->
        <div class="mt-4">
            <x-input-label for="cover" :value="__('نطاق التغطية')" />
            <x-text-input id="cover" class="block mt-1 w-full" type="text" name="cover" :value="old('cover')"
                required autocomplete="cover" />
            <x-input-error :messages="$errors->get('cover')" class="mt-2" />
        </div>
        <!-- Class -->
        <div class="mt-4">
            <x-input-label for="class" :value="__('تصنيف العميل')" />
            <x-text-input id="class" class="block mt-1 w-full" type="number" name="class" :value="old('class')"
                required />
            <x-input-error :messages="$errors->get('class')" class="mt-2" />
        </div>
        <!-- image -->
        <div class="mt-4">
            <x-input-label for="image" :value="__('تحميل صورة')" />
            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>
        <!-- Code -->
        <div class="mt-4">
            <x-input-label for="code" :value="__('كود العميل')" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')"/>
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>
        <!-- Min_Limit -->
        <div class="mt-4">
            <x-input-label for="min_limit" :value="__('الحد الأدنى ')" />
            <x-text-input id="min_limit" class="block mt-1 w-full" type="number" name="min_limit" :value="old('min_limit')"
                required autocomplete="min_limit" />
            <x-input-error :messages="$errors->get('min_limit')" class="mt-2" />
        </div>





        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('مسجل مسبقاً؟') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('تسجيل') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
