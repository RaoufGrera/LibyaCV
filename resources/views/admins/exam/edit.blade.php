
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
                    {!! Form::open(['action' => array('Admins\MangeExamController@updateExam', $exam->exam_id) ,'class'=>'form-style-2','method'=>'POST']) !!}

                    <table class="table">

                        <tr>
                            <td><lable>أسم الاختبار</lable></td>
                            <td><input type="text" class="form-control" id="exam_name" value="{{$exam->exam_name}}" name="exam_name" /></td>
                        </tr>
                        <tr>
                            <td><lable>عنوان url</lable></td>
                            <td><input type="text" class="form-control" id="url" value="{{$exam->url}}" name="url" /></td>
                        </tr>
                        <tr>
                            <td><lable>وصف الاختبار</lable></td>
                            <td><textarea  maxlength="2000"  class="txtArea" rows="80" name="desc" id="desc"  >{{$exam->desc}}</textarea></td>

                        </tr>
                        <tr>
                            <td>المستوي</td>
                            <td>
                                <select id="level_id" name="level_id" required>
                                    @foreach($level as $item)
                                        @if($item->level_id == $exam->level_id)
                                            <option value="{{$item->level_id}}" selected>{{$item->level_name}}</option>
                                            @continue
                                        @endif
                                        <option value="{{$item->level_id}}">{{$item->level_name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>المجال</td>
                            <td>
                                <select id="domain_id" name="domain_id" required>

                                    @foreach($domain as $item)
                                        @if($item->domain_id == $exam->domain_id)
                                            <option value="{{$item->domain_id}}" selected>{{$item->domain_name}}</option>
                                            @continue
                                        @endif
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
                                    <option @if($exam->isactive == '0') selected @endif value="0">غير مفعل </option>
                                    <option @if($exam->isactive == '1') selected @endif value="1">مفعل</option>
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
                                    <option value="0" @if($exam->price == '0') selected @endif >0</option>
                                    <option value="1000" @if($exam->price == '1000') selected @endif >1000</option>
                                    <option value="2000" @if($exam->price == '2000') selected @endif >2000</option>
                                    <option value="3000" @if($exam->price == '3000') selected @endif >3000</option>
                                    <option value="4000" @if($exam->price == '4000') selected @endif >4000</option>
                                    <option value="5000" @if($exam->price == '5000') selected @endif >5000</option>
                                    <option value="6000" @if($exam->price == '6000') selected @endif >6000</option>
                                    <option value="7000" @if($exam->price == '7000') selected @endif >7000</option>
                                    <option value="8000" @if($exam->price == '8000') selected @endif >8000</option>
                                    <option value="9000" @if($exam->price == '9000') selected @endif >9000</option>
                                    <option value="9999" @if($exam->price == '9999') selected @endif >9999</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label  for="time">
                                    مدة الاختبار

                                </label>
                            </td>
                            <td><input type="text" class="form-control" value="{{$exam->time}}" name="time" id="time" /></td>


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