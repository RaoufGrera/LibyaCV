
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
                <h5 class="title-page">ادارة الاختبار</h5>
                <br>

                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif

                    <table class="table">

                        <theader>
                            <td><lable>أسم الاختبار</lable></td>
                            <td>{{ $exam->exam_name }}</td>
                        </theader>
                        <tr>
                            <td>المستوي</td>
                            <td>{{ $exam->level_name }}</td>

                        </tr>
                        <tr>
                            <td>المجال</td>

                            <td>{{ $exam->domain_name }}</td>

                        </tr>
                        <tr>
                            <td>
                                <label  for="is_active">
                                    حالة الاختبار

                                </label>
                            </td>
                            <td>@if($exam->isactive == '0') غير مفعل  @else مفعل @endif</td>

                        </tr>

                        <tr>
                            <td>
                                <label  for="price">
                                    السعر

                                </label>
                            </td>
                            <td>{{ $exam->price }}</td>

                        </tr>

                        <tr>
                            <td>
                                <label  for="time">
                                    مدة الاختبار

                                </label>
                            </td>
                            <td>{{ $exam->time }}</td>


                        </tr>
                    </table>
                    <br>
                        <hr>
                    <h4>الأسئلة</h4>
<br>
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>السؤال</th>
                            <th>مفعل</th>
                            <th></th>
                        </tr>
                        <?php $i=1; ?>
                        @foreach($questions as $item)
                        <tr>

                                <td>{{ $i++ }}</td>
                                <td>{{ $item->question_name }}</td>
                                <td>@if($item->isactive == '0') غير مفعل  @else مفعل @endif</td>
                                <td><a href="/administrator/exam/{{$exam->exam_id}}/mange/{{$item->question_id}}/edit" class="btn btn-block btn-info">تعديل</a></td>



                        </tr>
                        @endforeach
                    </table>
                    <br>
                        <a href="/administrator/exam/{{$exam->exam_id}}/mange/create" class="btn btn-block btn-info">إضافة</a>


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