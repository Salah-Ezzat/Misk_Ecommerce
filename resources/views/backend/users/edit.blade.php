@extends('backend.main')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>تعديل بيانات عميل</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">الرئيسية</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('users.index') }}">العملاء</a></div>
                    <div class="breadcrumb-item">تعديل بيانات عميل</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                            </div>
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

                                <form method="POST" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label class="text-danger">رقم الهاتف</label>
                                        <input type="text" name="phone" value="{{ old('phone',$user->phone) }}"
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
                                                placeholder="اتركه فارغ إن لم ترغب بتعديل كلمة المرور">
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="text-danger">تأكيد الرقم السري</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="تأكيد كلمة المرور ">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="text-danger">اسم المحل</label>
                                        <input type="text" name="shop" value="{{ old('shop',$user->shop) }}"
                                            class="form-control" placeholder="اسم المحل...">
                                    </div>

                                    <div class="form-group">
                                        <label class="text-danger">اسم العميل</label>
                                        <input type="text" name="name" value="{{ old('name',$user->name) }}"
                                            class="form-control" placeholder="اسم العميل...">
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="text-danger">المحافظة</label>
                                            <select class="form-control" id="province" name="province">
                                                <option value="">اختر المحافظة</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}"
                                                        {{ old('province',$user->province) == $province->id ? 'selected' : '' }}>
                                                        {{ $province->province }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="text-danger">المدينة</label>
                                            <select class="form-control" id="city" name="city">
                                                <option value="{{ $user->city}}" selected >{{ is_numeric($user->city) ? $user->cityRelation->city : $user->city }} </option>
                                                {{-- يتم تعبئتها ديناميكيًا بالـ JS حسب المحافظة --}}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-danger">العنوان</label>
                                        <input type="text" name="address" value="{{ old('address',$user->address) }}"
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
                                                    {{ old('role_id',$user->role_id) == $role->id ? 'selected' : '' }}>
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
                                            <input type="text" name="code" value="{{ old('code',$user->code) }}"
                                                class="form-control" placeholder="الكود...">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="text-danger">الحد الأدنى</label>
                                            <input type="number" name="min_limit" value="{{ old('min_limit',$user->min_limit) }}"
                                                class="form-control" placeholder="الحد الأدنى...">
                                        </div>
                                    </div>
                                    <input type="hidden" name="confirm_add" value="1">
                                    <button type="submit" class="btn btn-success btn-block">تعديل بيانات</button>
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
        citySelect.innerHTML = '<option value="{{ $user->city}}">{{ $user->cityRelation->city }} </option>';
        filteredCities.forEach(city => {
            const option = document.createElement('option');
            option.value = city.id;
            option.textContent = city.city;
            citySelect.appendChild(option);
        });

        // تعبئة كل select من التلاتة
        $('.cover-select').each(function () {
            const select = $(this);
            select.empty();
            select.append('<option value="">نطاق التغطية</option>');

            filteredCities.forEach(city => {
                const option = new Option(city.city, city.city);
                select.append(option);
            });
        });
    }

    provinceSelect.addEventListener('change', function () {
        const selectedProvinceId = this.value;
        populateCitiesForProvince(selectedProvinceId);
    });

    // لو فيه محافظة محددة بالفعل، نملأ المدن تلقائيًا عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', function () {
        const currentProvince = provinceSelect.value;
        if (currentProvince) {
            populateCitiesForProvince(currentProvince);
        }
    });
</script>

@endsection
