@extends('backend.main')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>إضافة محافظة</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">الرئيسية</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('provinces.index') }}">المحافظات</a></div>
                    <div class="breadcrumb-item">إضافة محافظة</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <form action="{{ route('provinces.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>المحافظة</label>
                                        <input type="text" name="province" value="{{ old('province') }}" class="form-control"
                                            placeholder="أضف محافظة جديدة..">
                                        @error('province')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit">إضافة</button>
                            <a href="{{ route('provinces.index') }}" class="btn btn-secondary" type="button">رجوع</a>
                        </div>
                        </form>
                    </div>

                </div>

            </div>
    </div>
    </section>
    </div>
@endsection
