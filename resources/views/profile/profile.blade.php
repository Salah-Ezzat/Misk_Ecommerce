@extends('frontend.layout.main')

@section('style')
    <style>
        th.custom-colored {
            
            color: #1a73e8;
            /* نص أزرق */
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="far fa-user"></i> الملف الشخصي</h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">
                        <div class="row">
                            <!-- بيانات العميل -->
                            <div class="col-xl-9">
                                <h4>بيانات أساسية</h4>
                                <table class="table table-bordered table-striped text-end">
                                    <tbody>
                                        <tr>
                                            <th class="custom-colored">اسم العميل : </th>
                                            <td>{{ Auth::user()->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="custom-colored">اسم المحل :</th>
                                            <td>{{ Auth::user()->shop }}</td>
                                        </tr>
                                        <tr>
                                            <th class="custom-colored">رقم التليفون :</th>
                                            <td>{{ Auth::user()->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th class="custom-colored">المحافظة :</th>
                                            <td>{{ Auth::user()->province }}</td>
                                        </tr>
                                        <tr>
                                            <th class="custom-colored">المدينة : </th>
                                            <td>{{ Auth::user()->cityRelation->city ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="custom-colored">العنوان :</th>
                                            <td>{{ Auth::user()->address }}</td>
                                        </tr>
                                        <tr>
                                            <th class="custom-colored">التصنيف :</th>
                                            <td>{{ Auth::user()->role->role }}</td>
                                        </tr>
                                        <tr>
                                            <th class="custom-colored">نطاق التغطية :</th>
                                            <td>{{ Auth::user()->cover }}</td>
                                        </tr>
                                        <tr>
                                            <th class="custom-colored">الكود : </th>
                                            <td>{{ Auth::user()->code }}</td>
                                        </tr>
                                        <tr>
                                            <th class="custom-colored">الحد الأدنى :</th>
                                            <td>{{ Auth::user()->min_limit }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- صورة العميل -->
                            <div class="col-xl-3 col-md-4 text-center">
                                <img src="{{ asset('backend/assets/img/images/' . (Auth::user()?->image->image ?? 'No_Image.jpg')) }}"
                                    class="img-fluid rounded border" alt="صورة العميل">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
