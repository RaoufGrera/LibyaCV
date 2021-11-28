
@extends('layouts.header')
@section('content')
    <?php
    /**
     * Created by PhpStorm.
     * User: Asasna
     * Date: 24/06/2017
     * Time: 12:16 ص
     */?>

    <div class="container">
        <div class="row">
            @include('layouts.admins')
            <div class="col-md-9 ">
                <br>
                <h5 class="title-page"> كل الأختبارات</h5>
                <br>

                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif

                    <table class="table" width="100%">
                        <theader>
                            <th>اسم الاختبار</th>
                            <th>المستوي</th>
                            <th>المده الزمنية</th>
                            <th>مفعل</th>
                            <th>السعر</th>
                            <th></th>
                        </theader>

                        @foreach($exam as $item)
                            <tr>
                                <td>{{ $item->exam_name }}</td>
                                <td>{{ $item->level_name }}</td>
                                <td>{{ $item->time }}</td>
                                <td>@if($item->isactive == 1)
                                مفعل
                                @else
                                غير مفعل
                                @endif</td>
                                <td>{{ $item->price }}</td>
                                <td><a href="/administrator/exam/{{$item->exam_id}}/edit" class="btn btn-block btn-info">تعديل</a></td>
                                <td><a  href="/administrator/exam/{{$item->exam_id}}/mange" class="btn btn-block btn-info">ادارة الاسئلة</a></td>
                            </tr>
                            @endforeach
                    </table>
                        <br>
                        <td><a href="/administrator/exam/create" class="btn btn-block btn-info">إضافة</a></td>

                </div>
            </div>
        </div>

    </div>

    <script language="javascript">
        function deleteItem() {
            if (confirm("هل أنت متأكد من الحذف؟")) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@stop