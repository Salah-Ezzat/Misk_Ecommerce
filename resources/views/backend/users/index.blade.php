@extends('backend.main')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>قائمة العملاء</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">الرئيسية</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('users.index') }}">العملاء</a></div>
                    <div class="breadcrumb-item">قائمة العملاء </div>
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
                                <a href="{{ route('users.create') }}" class="btn btn-primary">إضافة عميل</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered display responsive nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="toggleAllColumns(this)">
                                                        إظهار التفاصيل
                                                    </button>
                                                </th>
                                                <th>المحل</th>
                                                <th>رقم التليفون</th>
                                                <th class="toggle-column" style="display: none;">الرقم السري</th>
                                                <th class="toggle-column" style="display: none;">الاسم</th>
                                                <th class="toggle-column" style="display: none;">المحافظة</th>
                                                <th>المدينة</th>
                                                <th class="toggle-column" style="display: none;">العنوان</th>
                                                <th>التصنيف</th>
                                                <th class="toggle-column" style="display: none;">نطاق التغطية</th>
                                                <th class="toggle-column" style="display: none;">الحد الأدنى</th>
                                                <th class="toggle-column" style="display: none;">الكود</th>
                                                <th>التحكم</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $index => $user)
                                                <tr>
                                                    <td>{{ $users->firstItem() + $index }}</td>
                                                    <td>{{ $user->shop }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td class="toggle-column" style="display: none;">{{ $user->password }}</td>
                                                    <td class="toggle-column" style="display: none;">{{ $user->name }}</td>
                                                    <td class="toggle-column" style="display: none;">{{ $user->province }}</td>
                                                    <td>{{ is_numeric($user->city) ? $user->cityRelation->city : $user->city }}</td>
                                                    <td class="toggle-column" style="display: none;">{{ $user->address }}</td>
                                                    <td>{{ $user->role->role }}</td>
                                                    <td class="toggle-column" style="display: none;">{{ $user->cover ? $user->cover : '-' }}</td>
                                                    <td class="toggle-column" style="display: none;">{{ $user->min_limit > 1 ? $user->min_limit : '-' }}</td>
                                                    <td class="toggle-column" style="display: none;">{{ $user->code ? $user->code : '-' }}</td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('users.edit', $user->id) }}"
                                                                class="btn btn-primary btn-sm">تعديل</a>
                                                            <form action="{{ route('users.destroy', $user->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('هل أنت متأكد من حذف {{ e($user->shop) }} ؟')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm"
                                                                    type="submit">حذف</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <!-- Pagination Links -->
                                    <div class="pagination">
                                        {{ $users->links() }}
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
@section('footer')

<script>
    function toggleAllColumns(btn) {
        const cols = document.querySelectorAll('.toggle-column');
        let isHidden = Array.from(cols).some(col => col.style.display === 'none');

        cols.forEach(col => {
            col.style.display = isHidden ? '' : 'none';
        });

        // تغيير نص الزر وشكله حسب الحالة
        if (isHidden) {
            btn.innerText = 'إخفاء التفاصيل';
            btn.classList.remove('btn-outline-primary');
            btn.classList.add('btn-success');
        } else {
            btn.innerText = 'إظهار التفاصيل';
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-primary');
        }
    }
</script>

 
@endsection