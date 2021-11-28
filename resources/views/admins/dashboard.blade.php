<?php $notes=null ?>
{{--@if( Auth::guard('users')->check()) @endif--}}
@inject('company','App\Helpers\CompanyConstant')
<?php
$notes = $company->getNote();
?>
@extends('layouts.header')
@section('content')
    <script type="application/javascript">
        function Toggle(item) {
            objReq = document.getElementById(item);
            visible = (objReq.style.display != "none")
            if (visible) {
                objReq.style.display = "none";
            } else {
                objReq.style.display = "block";
            }
        }

    </script>
    <div class="container">
        <div class="row">
            @include('layouts.admins')
            <div class="col-md-9 ">
                <br>

                <h5 class="title-page"> لوحة التحكم</h5>
                <br>
                <div class="cont contpost">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close"  data-dismiss="alert"    aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif



            </div>
            </div>
        </div>
        <nav id="bottom" class="bottom">
            <table>
                <tr>
                    <td><span  class="clicker t">إنتقل &#x25BE;&nbsp;</span>
                        <div class="subs">
                            <div class="wrp2">
                                        <ul class="navul">
                                             <a href="#contact">معلومات الأتصال</a>
                                             <a href="#golas">الهدف الوظيفي</a>
                                             <a href="#education">المؤهل العلمي</a>
                                            <a href="#experience">الخبرة</a>
                                             <a href="#language">اللغات</a>
                                            <a href="#specialtys">التخصصات</a>
                                             <a href="#skills">المهارات</a>
                                            <a href="#certificate">الشهادات</a>
                                            <a href="#training">التدريب</a>
                                            <a href="#hobby">الهويات</a>
                                            <a href="#info">معلومات إضافية</a>
                                        </ul>

                            </div>
                        </div>
                    </td>

                </tr>
            </table>
        </nav>
    </div>

    <script language="javascript">
        function deleteItem(a,b,c) {
            if (confirm("هل أنت متأكد من الحذف؟")) {
                var token = '{{ Session::token() }}';
                var data = {
                    '_token' : token,
                    '_method' : 'delete',
                };
                deleteRest(a,b,c,data);
                return true;
            } else {
                return false;
            }
        }
    </script>
@stop