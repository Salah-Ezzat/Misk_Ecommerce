@extends('backend.main')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>إضافة منتج</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">الرئيسية</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('products.index') }}">المنتجات</a></div>
                    <div class="breadcrumb-item">إضافة منتج</div>
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
                            
                            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label style="color:red">المنتج</label>
                                    <input type="text" name="product" class="form-control"
                                           value="{{ old('product') }}"
                                           placeholder="أضف منتج جديد..">
                                </div>
                            
                                <div class="form-group">
                                    <label style="color:red">العبوة</label>
                                    <input type="text" name="pack" class="form-control"
                                           value="{{ old('pack') }}"
                                           placeholder="العبوة...">
                                </div>
                            
                                <div class="form-group">
                                    <label style="color:red">تحميل صورة</label>
                                    <input type="file" name="images[]" multiple class="form-control">
                                </div>
                            
                                <div class="form-group">
                                    <label style="color:red">القسم</label>
                                    <select name="cat_id" id="cat_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('cat_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">إضافة</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary" type="button">رجوع</a>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
