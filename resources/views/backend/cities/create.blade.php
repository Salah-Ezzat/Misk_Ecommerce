@extends('backend.main')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>إضافة مدينة</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">الرئيسية</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('cities.index') }}">قائمة المدن</a></div>
                    <div class="breadcrumb-item">إضافة مدينة</div>
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
                            
                            <form action="{{ route('cities.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label style="color:red">المدينة</label>
                                    <input type="text" name="city" class="form-control"
                                           value="{{ old('city') }}"
                                           placeholder="أضف مدينة جديدة..">
                                </div>
                            

                            

                                <div class="form-group">
                                    <label style="color:red">المحافظة</label>
                                    <select name="province_id" id="province_id" class="form-control">
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}"
                                                {{ old('province_id') == $province->id ? 'selected' : '' }}>
                                                {{ $province->province }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">إضافة</button>
                                    <a href="{{ route('cities.index') }}" class="btn btn-secondary" type="button">رجوع</a>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
