@extends('backend.register')

@section('content')
    <!-- Main Content -->
    <div class="main-content mt-5">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('users.creatAccount') }}" enctype="multipart/form-data">
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
                                        <label class="text-danger">تصنيف العميل</label>
                                        <select name="role_id" class="form-control">
                                            <option value="1">مستخدم عادي </option>
  
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-danger">تحميل صورة</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm btn-block">إنشاء حساب</button>

                                </form>
                            </div>

                        </div>

                    </div>
                </div>
        </section>
    </div>
@endsection
@section('footer')
    <script>
        // تحميل المدن من الـ backend
        const cities = @json($cities);

        const provinceSelect = document.getElementById('province');
        const citySelect = document.getElementById('city');
        const coverSelect = document.getElementById('cover');

        function populateCitiesForProvince(provinceId) {
            const filteredCities = cities.filter(city => city.province_id == provinceId);

            // تعبئة المدينة
            citySelect.innerHTML = '<option value="">اختر المدينة</option>';
            filteredCities.forEach(city => {
                const option = document.createElement('option');
                option.value = city.id;
                option.textContent = city.city;
                citySelect.appendChild(option);
            });

            // تعبئة كل select من التلاتة
            $('.cover-select').each(function() {
                const select = $(this);
                select.empty();
                select.append('<option value="">نطاق التغطية</option>');

                filteredCities.forEach(city => {
                    const option = new Option(city.city, city.city);
                    select.append(option);
                });
            });
        }

        provinceSelect.addEventListener('change', function() {
            const selectedProvinceId = this.value;
            populateCitiesForProvince(selectedProvinceId);
        });

        // لو فيه محافظة محددة بالفعل، نملأ المدن تلقائيًا عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            const currentProvince = provinceSelect.value;
            if (currentProvince) {
                populateCitiesForProvince(currentProvince);
            }
        });
    </script>
@endsection
