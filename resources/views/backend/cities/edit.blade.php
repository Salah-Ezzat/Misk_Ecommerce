@extends('backend.main')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>تعديل مدينة</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">الرئيسية</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('cities.index') }}">قائمة المدن</a></div>
                    <div class="breadcrumb-item">تعديل مدينة</div>
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
                            
                            <form action="{{ route('cities.update', $city->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            
                                <div class="form-group">
                                    <label style="color:red ">المدينة</label>
                                    <input type="text" name="city" class="form-control"
                                        value="{{ old('city', $city->city) }}" placeholder="أدخل اسم المدينة..">
                                </div>
                            
                                <div class="form-group">
                                    <label style="color:red ">المحافظة</label>
                                    <select name="province_id" id="province_id" class="form-control">
                                        @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}"
                                            {{ old('province_id', $city->province_id) == $province->id ? 'selected' : '' }}>
                                            {{ $province->province }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            
                                <div class="card-footer text-right">
                                    <button class="btn btn-success mr-1" type="submit">تحديث</button>
                                    <a href="{{ route('cities.index') }}" class="btn btn-secondary" type="button">رجوع</a>
                                </div>
                            </form>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
