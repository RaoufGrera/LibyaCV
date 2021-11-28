
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
                <h5 class="title-page">إضافة اختبار جديد</h5>
                <br>

                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close" data-dismiss="alert"
                               aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif
                        {!! Form::open(['action' => 'Admins\MangeExamController@storeExam' ,'class'=>'form-style-2','method'=>'POST']) !!}

                    <table class="table">

                            <tr>
                                <td><lable>أسم الاختبار</lable></td>
                                <td><input type="text" class="form-control" id="exam_name" name="exam_name" /></td>
                            </tr>
                        <tr>
                        <tr>
                            <td><lable>عنوان url</lable></td>
                            <td><input type="text" class="form-control" id="url"   name="url" /></td>
                        </tr>
                        <tr>
                            <td><lable>وصف الاختبار</lable></td>
                            <td><textarea  maxlength="2000"  class="txtArea" rows="80" name="desc" id="desc"  ></textarea></td>

                        </tr>
                        <td>المستوي</td>
                                <td>
                                    <select id="level_id" name="level_id" required>
                                        <option value="" selected="selected">
                                            المستوي
                                        </option>
                                        @foreach($level as $levels)
                                            <option value="{{$levels->level_id}}">{{$levels->level_name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                             </tr>
                        <tr>
                            <td>المجال</td>
                            <td>
                                <select id="domain_id" name="domain_id" required>
                                    <option value="" selected="selected">
                                        المجال
                                    </option>
                                    @foreach($domain as $item)
                                        <option value="{{$item->domain_id}}">{{$item->domain_name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label  for="is_active">
                                    حالة الاختبار

                                </label>
                            </td>
                            <td>
                                <select name="is_active" >
                                    <option value="0">غير مفعل </option>
                                    <option value="1">مفعل</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label  for="price">
                                   السعر

                                </label>
                            </td>
                            <td>
                                <select name="price" >
                                    <option value="0">0</option>
                                    <option value="1000">1000</option>
                                    <option value="2000">2000</option>
                                    <option value="3000">3000</option>
                                    <option value="4000">4000</option>
                                    <option value="5000">5000</option>
                                    <option value="6000">6000</option>
                                    <option value="7000">7000</option>
                                    <option value="8000">8000</option>
                                    <option value="9000">9000</option>
                                    <option value="9999">9999</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label  for="time">
                                    مدة الاختبار

                                </label>
                            </td>
                             <td><input type="text" class="form-control" id="time" /></td>


                        </tr>
                    </table>
                    <br>
                        <button type="submit" class="btn   btn-info" >حفظ</button>
                        {!! Form::close() !!}

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