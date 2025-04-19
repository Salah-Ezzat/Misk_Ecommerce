@extends('backend.main')
@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>المحافظات</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">الرئيسية</a></div>
                    <div class="breadcrumb-item"><a href="#">المحافظات</a></div>
                    <div class="breadcrumb-item">المحافظات المتاحة</div>
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

                @if (session()->has('Add'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('Add') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session()->has('delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('delete') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
                            <div class="mt-2">
                                <a href="{{ route('provinces.create') }}" class="btn btn-primary">إضافة محافظة</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tr>
                                            <th>#</th>
                                            <th>المحافظة</th>
                                            <th>التحكم</th>
                                        </tr>
                                      

                                        @foreach ($provinces as $index => $province)
                                            
                                            <tr>
                                                <td>{{ $provinces->firstItem() + $index }}</td>
                                                <td>{{ $province->province }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('provinces.edit', $province->id) }}"
                                                            class="btn btn-primary">تعديل</a>
                                                        <form action="{{ route('provinces.destroy', $province->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('هل أنت متأكد من حذف {{ e($province->province) }}؟')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit">حذف</button>
                                                        </form>
                                                    </div>

                                                </td>

                                            </tr>
                                        @endforeach

                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <!-- Pagination Links -->
                                    <div class="pagination">
                                        {{ $provinces->links() }}
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
