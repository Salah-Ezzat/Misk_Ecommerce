@extends('backend.main')


@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>الإعلانات</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">الرئيسية</a></div>
                    <div class="breadcrumb-item"><a href="#">الإعلانات</a></div>
                    <div class="breadcrumb-item">صور الإعلانات </div>
                </div>
            </div>

            <div class="section-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session()->has('edit'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('edit') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tr>
                                            <th>#</th>
                                            <th>صورة الإعلان</th>
                                            <th>النص الأعلى</th>
                                            <th>النص الأوسط</th>
                                            <th>النص الأسفل</th>
                                            <th>التحكم</th>
                                        </tr>

                                        @foreach ($banners as $banner)
                                            <tr>
                                                <td>{{ $banner->id }}</td>
                                                <td><img src="{{ asset('backend/assets/img/banners/' . $banner->img) }}"
                                                        width="100"></td>
                                                        <td>{{ $banner->top_text }} </td>
                                                        <td>{{ $banner->middle_text }} </td>
                                                        <td>{{ $banner->bottom_text }} </td>
                                                       
                                                <td>
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="toggleEditRow({{ $banner->id }})">تغيير الصورة</button>
                                                </td>
                                            </tr>

                                            <tr id="editRow-{{ $banner->id }}" style="display: none;">
                                                <td colspan="2">
                                                    <form action="{{ route('banners.updateImage', $banner->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT') 

                                                        <div class="form-group">
                                                            <div class="custom-file">
                                                                <input type="file" name="new_image" class="custom-file-input" id="new_image_{{ $banner->id }}" required>
                                                                <label class="custom-file-label" for="new_image_{{ $banner->id }}">اختر صورة </label>
                                                            </div>
                                                        </div>
                                                        
                                                        </td>
                                                        <td> <input type="text" class="custom-input" name="top_text" value="{{ old('top_text') }}"  placeholder="... النص العلوي" ></td>
                                                        <td> <input type="text" name="middle_text" value="{{ old('middle_text') }}"  placeholder="... النص الأوسط"></td>
                                                        <td> <input type="text" name="bottom_text" value="{{ old('bottom_text') }}"  placeholder="... النص السفلي"></td>

                                                        <td>

                                                        <button type="submit" class="btn btn-primary mt-2">حفظ
                                                            التغييرات</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('footer')
    <script>
        function toggleEditRow(id) {
            const row = document.getElementById('editRow-' + id);
            row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('.custom-file-input').on('change', function () {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });
        });
    </script>
    
@endsection
