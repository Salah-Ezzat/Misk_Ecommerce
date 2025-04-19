@extends('backend.main')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>إضافة قسم</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">الرئيسية</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('categories.index') }}">الأقسام</a></div>
                    <div class="breadcrumb-item">إضافة قسم</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <form action="{{ route('categories.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>القسم</label>
                                        <input type="text" name="category" value="{{ old('category') }}" class="form-control"
                                            placeholder="أضف قسم جديد..">
                                            @error('category')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">إضافة</button>
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary"
                                    type="button">رجوع</a>
                            </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
