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
            <div class="col-md-3">
                <ul class="nav nav-list">

                    <li><span class="menus "><strong>القائمة الرئيسية</strong></span>
                    </li>
                    <li class="active"><a href="profile"></i>السيرة الذاتية</a></li>
                    <ul class="listcv">
                        <li><a href="#education">المؤهل العلمي</a></li>
                        <li><a href="#experience">الخبرة</a></li>
                        <li><a href="#language">اللغات</a></li>
                        <li><a href="#skills">المهارات</a></li>
                        <li><a href="#certificate">الشهادات</a></li>
                        <li><a href="#training">التدريب والدورات</a></li>
                        <li><a href="#">fdafd</a></li>
                        <li><a href="#">fdafd</a></li>
                    </ul>

                    <li>
                        <a href="seekerreq.php"> طلبات التوظيف</a>
                    </li>
                    <li>
                        <a href="seekersave.php">الوظائف المحفوظة</a>
                    </li>
                    <li>
                        <a href="settings.php">أعدادات الحساب</a>
                    </li>
                </ul>

            </div>

            <div class="col-md-9 ">
                <br>
                <h5 class="title-page"> الشركة</h5>
                <br>
                <div class="cont">
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <a href="javascript:void(0);" class="close"  data-dismiss="alert"    aria-label="close">&times;</a>

                            <strong>تنبيه!</strong> {{  session('error') }}
                        </div>
                    @endif

                            <legend>تغيير كلمة السر</legend><br/>
                        {!! Form::open(["url"=>"company","method"=>"PATCH","class"=>"form-style-2"]) !!}
                                <table>


                                    <tr>
                                        <!-- -->
                                        <td>
                                            <label class="control-label" for="pass_old">
                                                الرقم السري
                                                <span  class="req">*</span>
                                            </label>
                                        </td>
                                        <td>
                                            <input autocomplete="off" id="pass_old" name="pass_old" type="text" placeholder="الرقم السري الحالي" required />
<br>
                                        </td>

                                    </tr>
                                    <tr>
                                        <!-- -->
                                        <td>
                                            <label class="control-label" for="pass_new">الرقم  الجديد
                                                <span  class="req">*</span>
                                            </label>
                                        </td>
                                        <td>
                                            <input autocomplete="off" id="pass_new" name="pass_new" type="text" placeholder="الرقم السري الجديد" required />
                                        </td>
                                        <td>
                                            <div>
                                            </div>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>

                                </table>



                                    <input class="btn btn-info " name="submit" type="submit" value="تغيير" />
                           {!! Form::close() !!}



                            <legend><a name="personalinfo"></a>المعلومات الشخصية</legend><br/>
                            <table>
                                <tr>
                                    <td>
                                        <label class="control-labe">
                                            البريد الألكتروني :
                                        </label><span class="texttt"><?php echo $employers->email; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="control-labe">
                                            الأسم :
                                        </label><span class="texttt"><?php echo $employers->fname; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="control-labe">
                                            اللقب :
                                        </label><span class="texttt"><?php echo $employers->lname; ?></span>
                                    </td>
                                </tr>
                            </table>

                            <p>
                                <a href="modal_edit_pe.php"  class="btn btn-info facebox" >تعديل</a>


                        <p>

                                <legend><a name="contact"></a>حذف الحساب</legend><br/>
                                <form name="fooorm" action="" method="post" onsubmit="return confirm('هل أنت متأكد من حذف الحساب الخاص بك ؟');" >
                                    <span class="texts">عند النقر علي زر حذف الحساب سيتم حذف حسابك نهائياً من الموقع . </span><br/><br/>
                                    <input name="delete_user" class="btn btn-info " onclick="return confirm(\'هل أنت متأكد من الحذف ?\')" type="submit" value="حذف الحساب " />
                                </form><p>




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